<?php

namespace johnitvn\rbacplus\models;

use Yii;
use yii\rbac\Item;

/**
 * @author John Martin <john.itvn@gmail.com>
 * @since 1.0.0
 */
class Role extends AuthItem {

    public $permissions = [];
    public $roles = [];

    public function init() {
        parent::init();
        if (!$this->isNewRecord) {
            $permissions = [];
            foreach (static::getPermistions($this->item->name) as $permission) {
                $permissions[] = $permission->name;
            }
            $this->permissions = $permissions;

            $roles = [];
            foreach (static::getRoles($this->item->name) as $role) {
                $roles[] = $role->name;
            }
            $this->roles = $roles;
        }
    }

    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios['default'][] = 'permissions';
        $scenarios['default'][] = 'roles';
        return $scenarios;
    }

    protected function getType() {
        return Item::TYPE_ROLE;
    }

    public function afterSave($insert, $changedAttributes) {
        $authManager = Yii::$app->authManager;
        $role = $authManager->getRole($this->item->name);
        if (!$insert) {
            $authManager->removeChildren($role);
        }
        if ($this->permissions != null && is_array($this->permissions)) {
            foreach ($this->permissions as $permissionName) {
                $permistion = $authManager->getPermission($permissionName);
                $authManager->addChild($role, $permistion);
            }
        }
    }

    public function attributeLabels() {
        $labels = parent::attributeLabels();
        $labels['name'] = Yii::t('rbac', 'Role name');
        $labels['permissions'] = Yii::t('rbac', 'Permissions');
        return $labels;
    }

    public static function find($name) {
        $authManager = Yii::$app->authManager;
        $item = $authManager->getRole($name);
        return new self($item);
    }

    public static function getPermistions($name) {
        $authManager = Yii::$app->authManager;
        return $authManager->getPermissionsByRole($name);
    }

    public static function getRoles($name) {
        $authManager = Yii::$app->authManager;
        $children = $authManager->getChildren($name);
        foreach ($children as $child) {
            if ($child->type == 2) {
                unset($children[$child->name]);
            }
        }
        return $children;
    }

}
