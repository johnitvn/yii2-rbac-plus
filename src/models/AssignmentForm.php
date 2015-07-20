<?php

namespace johnitvn\rbacplus\models;

use Yii;
use yii\base\Model;

/**
 * Description of newPHPClass
 *
 * @author John Martin <john.itvn@gmail.com>
 * @since 1.0.0
 */
class AssignmentForm extends Model {

    public $userId;
    public $roles = [];
    public $authManager;

    public function __construct($userId, $config = array()) {
        parent::__construct($config);
        $this->userId = $userId;
        $this->authManager = Yii::$app->authManager;
        foreach ($this->authManager->getRolesByUser($userId) as $role) {
            $this->roles[] = $role->name;
        }
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['userId'], 'required'],
            [['roles'], 'default'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'userId' => Yii::t('rbac', 'User ID'),
            'roles' => Yii::t('rbac', 'Roles'),
        ];
    }

    public function save() {
        Yii::trace('On Save');
        $this->authManager->revokeAll(intval($this->userId));
        foreach ($this->roles as $role) {
            $this->authManager->assign($this->authManager->getRole($role), $this->userId);
        }
        return true;
    }

}