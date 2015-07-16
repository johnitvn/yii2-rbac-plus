<?php

namespace johnitvn\rbacplus\models;

use Yii;
use yii\rbac\Item;
use johnitvn\rbacplus\AuthItemManager;

/**
 * Description of Permistion
 *
 * @author John Martin <john.itvn@gmail.com>
 * @since 1.0.0
 */
class Permission extends AuthItem {

    protected function getType() {
        return Item::TYPE_PERMISSION;
    }

    public function attributeLabels() {
        $labels = parent::attributeLabels();
        $labels['name'] = Yii::t('rbac', 'Permission name');
        return $labels;
    }
    
    public static function find($name) {
        return new self(AuthItemManager::getItem($name, Item::TYPE_PERMISSION));
    }

}
