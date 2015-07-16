<?php

namespace johnitvn\rbacplus;

use Yii;
use yii\rbac\Item;

/**
 * Description of Manager
 *
 * @author John Martin <john.itvn@gmail.com>
 * @since 1.0.0
 */
class AuthItemManager {
    
    public static function deleteItem($name,$type) {
        $authManager = Yii::$app->authManager;       
        return $authManager->remove(static::getItem($name, $type));
    }

    public static function getItems($type) {
        $authManager = Yii::$app->authManager;
        if ($type == Item::TYPE_ROLE) {
            $items = $authManager->getRoles();
        } else {
            $items = $authManager->getPermissions();
        }
        return $items;
    }

    /**
     * 
     * @param string $name
     * @param integer $type
     * @return \yii\rbac\Item
     */
    public static function getItem($name, $type) {
        $authManager = Yii::$app->authManager;
        if ($type == Item::TYPE_PERMISSION) {
            $item = $authManager->getPermission($name);
        } else {
            $item = $authManager->getRole($name);
        }
        return $item;
    }

    /**
     * 
     * @param string $name
     * @param integer $type
     * @return \yii\rbac\Item
     */
    public static function createItem($name, $type) {
        $authManager = Yii::$app->authManager;
        if ($type == Item::TYPE_PERMISSION) {
            $item = $authManager->createPermission($name);
        } else {
            $item = $authManager->createRole($name);
        }
        return $item;
    }

    /**
     * 
     * @param Item $item
     * @return bool
     */
    public static function add(Item $item) {
        $authManager = Yii::$app->authManager;
        return $authManager->add($item);
    }

    /**
     * 
     * @param string $oldName
     * @param Item $item
     * @return bool
     */
    public static function update($oldName, Item $item) {
        $authManager = Yii::$app->authManager;
        return $authManager->update($oldName, $item);
    }

}
