<?php

namespace johnitvn\rbacplus\models;

use yii\base\Model;

/**
 * @author John Martin <john.itvn@gmail.com>
 * @since 1.0.0
 */
abstract class Rule extends Model {

    public $name;
    public $data;
    public $isNewRecord = true;

}
