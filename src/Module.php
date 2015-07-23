<?php

namespace johnitvn\rbacplus;

use Yii;
use yii\base\Module as BaseModule;

/**
 * Description of Module
 *
 * @author John Martin <john.itvn@gmail.com>
 * @since 1.0.0
 */
class Module extends BaseModule {

    /**
     *
     * @var string $userModelClassName The user model class.
     * Default it will get from `Yii::$app->getUser()->identityClass`
     */
    public $userModelClassName;

    /**
     *
     * @var string $userModelIdField the id field name of user model.
     * Default is id
     */
    public $userModelIdField = 'id';

    /**
     *
     * @var string $userModelLoginField the login field name of user model.
     * Default is username
     */
    public $userModelLoginField = 'username';

    /**
     *
     * @var string $userModelLoginFieldLabel The login field's label of user model.
     * Default is Username  
     */
    public $userModelLoginFieldLabel;

    /**
     *
     * @var array|null $userModelExtraDataColumks the array of extra colums of user model want to show in
     * assignment index view. 
     */
    public $userModelExtraDataColumls;

    /**
     * Callback before create controller
     * @var mixed 
     */
    public $beforeCreateController = null;

    /**
     * Callback before create action
     * @var type 
     */
    public $beforeAction = null;

    /**
     * Initilation module
     * @return void
     */
    public function init() {
        parent::init();
        if ($this->userModelClassName == null) {
            if (Yii::$app->has('user')) {
                $this->userModelClassName = Yii::$app->user->identityClass;
            } else {
                throw new yii\base\Exception("You must config user compoment both console and web config");
            }
        }
        if ($this->userModelLoginFieldLabel == null) {
            $model = new $this->userModelClassName;
            $this->userModelLoginFieldLabel = $model->getAttributeLabel($this->userModelLoginField);
        }
    }

    public function createController($route) {
        if ($this->beforeCreateController !== null && !call_user_func($this->beforeCreateController, $route)) {
            return false;
        }
        return parent::createController($route);
    }

    public function beforeAction($action) {
        if ($this->beforeAction !== null && !call_user_func($this->beforeAction, $action)) {
            return false;
        }
        return parent::beforeAction($action);
    }

}
