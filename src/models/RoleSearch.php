<?php

namespace johnitvn\rbacplus\models;

use Yii;
use yii\rbac\Item;

/**
 * Description of Permistion
 *
 * @author John Martin <john.itvn@gmail.com>
 * @since 1.0.0
 */
class RoleSearch extends AuthItemSearch {

    public function __construct($config = array()) {
        parent::__construct($item = null, $config);
    }

    public function attributeLabels() {
        $labels = parent::attributeLabels();
        $labels['name'] = Yii::t('rbac', 'Role name');
        $labels['permissions'] = Yii::t('rbac', 'Permissions');
        return $labels;
    }

    protected function getType() {
        return Item::TYPE_ROLE;
    }

}
