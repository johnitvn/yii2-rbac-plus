<?php

namespace johnitvn\rbacplus\models;

use Yii;
use yii\base\Model;
use yii\rbac\Item;


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
    //public abstract static function find($name);

    /**
     * Save item
     * @return boolean
     */
    public function save() {

        if (!$this->validate()) {
            return false;
        }

        //$this->beforeSave();
        $authManager = Yii::$app->authManager;

        // Create new item    
        if ($this->getType() == Item::TYPE_ROLE) {
            $item = $authManager->createRole($this->name);
        } else {
            $item = $authManager->createPermission($this->name);
        }

        // Set item data
        $item->description = $this->description;
        $item->ruleName = $this->ruleName;
        $item->data = $this->data === null || $this->data === '' ? null : Json::decode($this->data);

        // save
        if ($this->item == null && !$authManager->add($item)) {
            return false;
        } else if ($this->item !== null && !$authManager->update($this->item->name, $item)) {
            return false;
        }

        $isNewRecord = $this->item == null ? true : false;
        $this->isNewRecord = !$isNewRecord;
        $this->item = $item;
        //$this->afterSave($isNewRecord,$this->attributes);
        
        
        if ($this->getType() == Item::TYPE_ROLE) {
	        $role = $authManager->getRole($this->item->name);
	        if (!$isNewRecord) {
	            $authManager->removeChildren($role);
	        }
	        if ($this->permissions != null && is_array($this->permissions)) {
	            foreach ($this->permissions as $permissionName) {
	                $permistion = $authManager->getPermission($permissionName);
	                $authManager->addChild($role, $permistion);
	            }
	        }
        }
        

        return true;
    }
    
   
    /**
     * Delete AuthItem
     * @return  boolean whether the role or permission is successfully removed
     * @throws \yii\base\Exception When call delete() function in new record
     */
    public function delete() {
        if ($this->isNewRecord) {
            throw new \yii\base\Exception("Call delete() function in new record");
        }


        $authManager = Yii::$app->authManager;

        // Create new item    
        if ($this->getType() == Item::TYPE_ROLE) {
            $item = $authManager->getRole($this->name);
        } else {
            $item = $authManager->getPermission($this->name);
        }

        return $authManager->remove($item);
    }

    /**
     * Get the type of item
     * @return integer 
     */
    protected abstract function getType();
}
