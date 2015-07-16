<?php

namespace johnitvn\rbacplus\models;

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

    protected function getType() {
        return Item::TYPE_ROLE;
    }

}
