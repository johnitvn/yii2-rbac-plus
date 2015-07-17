<?php

namespace johnitvn\rbacplus\models;

use Yii;
use yii\base\Model;
use johnitvn\rbacplus\AuthItemManager;

/**
 * @author John Martin <john.itvn@gmail.com>
 * @since 1.0.0
 */
abstract class AuthItem extends Model {
    
    protected $item;
    public $name;
    public $description;
    public $ruleName;
    public $data;
    public $isNewRecord = true;

    /**
     * @param yii\rbac\Item $item
     * @param array $config name-value pairs that will be used to initialize the object properties
     */
    public function __construct($item, $config = array()) {
        $this->item = $item;
        if ($item !== null) {
            $this->isNewRecord = false;
            $this->name = $item->name;
            $this->description = $item->description;
            $this->ruleName = $item->ruleName;
            $this->data = $item->data === null ? null : Json::encode($item->data);
        }
        parent::__construct($config);
    }

    public function unique() {
        $authManager = Yii::$app->authManager;
        $value = $this->name;
        if ($authManager->getRole($value) !== null || $authManager->getPermission($value) !== null) {
            $message = Yii::t('yii', '{attribute} "{value}" has already been taken.');
            $params = [
                'attribute' => $this->getAttributeLabel('name'),
                'value' => $value,
            ];
            $this->addError('name', Yii::$app->getI18n()->format($message, $params, Yii::$app->language));
        }
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['ruleName'], 'in',
                'range' => array_keys(Yii::$app->authManager->getRules()),
                'message' => Yii::t('rbac', 'Rule not exists')],
            [['name'], 'required'],
            [['name'], 'unique', 'when' => function() {
            return $this->isNewRecord || ($this->item->name != $this->name);
        }],
            [['description', 'data', 'ruleName'], 'default'],
            [['name'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'name' => Yii::t('rbac', 'Name'),
            'description' => Yii::t('rbac', 'Description'),
            'ruleName' => Yii::t('rbac', 'Rule Name'),
            'data' => Yii::t('rbac', 'Data'),
        ];
    }

    /**
     * Find auth item
     * @param type $name
     * @return AuthItem
     */
    public abstract static function find($name);

    /**
     * Save item
     * @return boolean
     */
    public function save() {

        if (!$this->validate()) {
            return false;
        }
        
        $this->beforeSave();
        $item = AuthItemManager::createItem($this->name, $this->getType());
        $item->description = $this->description;
        $item->ruleName = $this->ruleName;
        $item->data = $this->data === null || $this->data === '' ? null : Json::decode($this->data);

        if ($this->item == null && !AuthItemManager::add($item)) {
            return false;
        } else if ($this->item !== null && !AuthItemManager::update($this->item->name, $item)) {
            return false;
        }
        $isNewRecord = $this->item == null?true:false;
        $this->isNewRecord = !$isNewRecord;
        $this->item = $item;
        $this->afterSave($isNewRecord);        
        return true;
    }
    
    public function beforeSave(){
        
    }
    
    public function afterSave(){
        
    }
    
    

    public function delete() {
        if ($this->isNewRecord) {
            throw new \yii\base\Exception("Call delete() function in new record");
        }
        return AuthItemManager::deleteItem($this->name, $this->getType());
    }

    /**
     * Get the type of item
     * @return integer 
     */
    protected abstract function getType();
}
