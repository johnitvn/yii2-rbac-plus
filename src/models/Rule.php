<?php

namespace johnitvn\rbacplus\models;

use Yii;
use yii\base\Model;

/**
 * @author John Martin <john.itvn@gmail.com>
 * @since 1.0.0
 */
class Rule extends Model {

    /**
     *
     * @var string 
     */
    public $name;

    /**
     * @var string classname of Rule
     */
    public $className;

    /**
     * @var \yii\rbac\Rule
     */
    private $item;

    /**
     * @var boolean 
     */
    public $isNewRecord = true;

    /**
     * Initilaize object
     * @param \yii\rbac\Rule $item
     * @param array $config
     */
    public function __construct($item, $config = []) {
        $this->item = $item;
        if ($item !== null) {
            $this->name = $item->name;
            $this->className = get_class($item);
            $this->isNewRecord = false;
        }
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'className'], 'required'],
            [['name'], 'unique', 'when' => function() {
            return $this->isNewRecord || ($this->item->name != $this->name);
        }],
            [['className'], 'string'],
            [['className'], 'classExists']
        ];
    }

    /**
     * Check rule name is unique if not add error
     */
    public function unique() {
        $authManager = Yii::$app->authManager;
        $value = $this->name;
        if ($authManager->getRule($value) !== null) {
            $message = Yii::t('yii', '{attribute} "{value}" has already been taken.');
            $params = [
                'attribute' => $this->getAttributeLabel('name'),
                'value' => $value,
            ];
            $this->addError('name', Yii::$app->getI18n()->format($message, $params, Yii::$app->language));
        }
    }

    /**
     * Validate class exists
     */
    public function classExists() {
        $message = null;
        if (!class_exists($this->className)) {
            $message = 'Class "{className}" not exist';
        } else if (!is_subclass_of($this->className, yii\rbac\Rule::className())) {
            $message = 'Class "{className}" must extends yii\rbac\Rule';
        } else if ((new $this->className())->name === null) {
            $message = 'The "{className}::\$name" is not set';
        } else if ((new $this->className())->name !== $this->name) {
            $message = 'The "{className}::\$name" is incorrect with the name of rule you have set';
        }

        if ($message !== null) {
            $this->addError('className', Yii::t('rbac', $message, ['className' => $this->className]));
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'name' => Yii::t('rbac', 'Rule Name'),
            'className' => Yii::t('rbac', 'Class Name'),
        ];
    }

    /**
     * Find model by id
     * @param type $id
     * @return null|static
     */
    public static function find($id) {
        $item = Yii::$app->authManager->getRule($id);
        if ($item !== null) {
            return new self($item);
        }
        return null;
    }

    /**
     * Save model to authManager
     * @return boolean
     */
    public function save() {
        if (!$this->validate()) {
            return false;
        }
        $manager = Yii::$app->authManager;
        $class = $this->className;
        if ($this->item == null) {
            $item = new $class();
            if (!$manager->add($item)) {
                return false;
            }
            $this->item = $item;
        } else {
            $item = new $class();
            if (!$manager->update($this->item->name, $item)) {
                return false;
            }
            $this->item = $item;
        }
        $this->isNewRecord = false;
        return true;
    }

    /**
     * Delete rule
     * @return  boolean whether the rule is successfully removed
     * @throws \yii\base\Exception When call delete() function in new record
     */
    public function delete() {
        if ($this->isNewRecord) {
            throw new \yii\base\Exception("Call delete() function in new record");
        }
        $authManager = Yii::$app->authManager;
        return $authManager->remove($this->item);
    }

}
