<?php

namespace johnitvn\rbacplus\controllers;

use Yii;
use yii\web\Controller;
use johnitvn\rbacplus\models\AssignmentSearch;

/**
 * Description of ManagerController
 *
 * @author John Martin <john.itvn@gmail.com>
 * @since 1.0.0
 * @property \johnitvn\rbacplus\Module $rbacModule
 */
class ManagerController extends Controller {

    protected $rbacModule;

    public function init() {
        parent::init();
        $this->rbacModule = Yii::$app->getModule('rbac');
    }

    public function actionIndex() {
        $searchModel = new AssignmentSearch;
        $dataProvider = $searchModel->search();      
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
                    'idField' => $this->rbacModule->userModelIdField,
                    'usernameField' => $this->rbacModule->userModelLoginField,
        ]);
    }

}
