<?php

namespace johnitvn\rbacplus\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\Html;
use johnitvn\rbacplus\models\Permission;
use johnitvn\rbacplus\models\PermissionSearch;

/**
 * PermistionController implements the CRUD actions for AuthItem model.
 */
class PermistionController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Permission models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new PermissionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Permission model.
     * @param string $name
     * @return mixed
     */
    public function actionView($name) {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "Permistion #" . $name,
                'content' => $this->renderPartial('view', [
                    'model' => $this->findModel($name),
                ]),
                'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                Html::a('Edit', ['update', 'name' => $name], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        } else {
            return $this->render('view', [
                        'model' => $this->findModel($name),
            ]);
        }
    }

    /**
     * Creates a new Permission model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $request = Yii::$app->request;
        $model = new Permission(null);

        if ($request->isAjax) {
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Create new permistion",
                    'content' => $this->renderPartial('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => 'true',
                    'title' => "Create new permistion",
                    'content' => '<span class="text-success">Create AuthItem success</span>',
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a('Create More', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {               
                return [
                    'title' => "Create new permistion",
                    'content' => $this->renderPartial('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
            /*
             *   Process for non-ajax request
             */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'name' => $model->name]);
            } else {
                return $this->render('create', [
                            'model' => $model,
                ]);
            }
        }
    }

    /**
     * Updates an existing Permission model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param string $name
     * @return mixed
     */
    public function actionUpdate($name) {
        $request = Yii::$app->request;
        $model = $this->findModel($name);

        if ($request->isAjax) {
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Update permistion #" . $name,
                    'content' => $this->renderPartial('update', [
                        'model' => $this->findModel($name),
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => 'true',
                    'title' => "Permistion #" . $name,
                    'content' => $this->renderPartial('view', [
                        'model' => $this->findModel($name),
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a('Edit', ['update', 'name' => $name], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => "Update permistion #" . $name,
                    'content' => $this->renderPartial('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
            /*
             *   Process for non-ajax request
             */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'name' => $model->name]);
            } else {
                return $this->render('update', [
                            'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing Permission model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $name
     * @return mixed
     */
    public function actionDelete($name) {
        $request = Yii::$app->request;
        $this->findModel($name)->delete();

        if ($request->isAjax) {
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => true];
        } else {
            /*
             *   Process for non-ajax request
             */
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Permission model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $name
     * @return Permission the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($name) {
        if (($model = Permission::find($name)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
