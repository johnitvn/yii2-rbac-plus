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
    public $userModelLoginFieldLabel = 'Username';

    /**
     *
     * @var array|null $userModelExtraDataColumks the array of extra colums of user model want to show in
     * assignment index view. 
     */
    public $userModelExtraDataColumls;

    /**
     * Initilation module
     * @return void
     */
    public function init() {
        parent::init();
        if ($this->userModelClassName == null) {
            $this->userModelClassName = Yii::$app->getUser()->identityClass;
        }
        $this->userModelLoginFieldLabel = Yii::t('rbac', $this->userModelLoginFieldLabel);
    }

}
