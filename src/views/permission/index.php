<?php
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use amintado\ajaxcrud\CrudAsset;

/* @var $this yii\web\View */
/* @var $searchModel amintado\rbacplus\models\AuthItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('rbac','Permisstions Manager');
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
        	<div class="panel-body">
        	   <?= Yii::t('rbac', 'Both roles and permissions can be organized in a hierarchy. In particular, a role may consist of other roles or permissions; and a permission may consist of other permissions. Yii implements a partial order hierarchy which includes the more special tree hierarchy. While a role can contain a permission, it is not true vice versa.') ?> 
        	</div>
        </div>
    </div>
</div>
<div class="auth-item-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toggleDataOptions'=>[
                'all' => [
                   'icon' => 'resize-full',
                   'class' => 'btn btn-default',
                   'label' => Yii::t('rbac','All'),
                   'title' => Yii::t('rbac','Show all data')
               ],
               'page' => [
                   'icon' => 'resize-small',
                   'class' => 'btn btn-default',
                   'label' => Yii::t('rbac', 'Page'),
                   'title' => Yii::t('rbac','Show first page data')                   
               ],
            ],
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],
                    ['role'=>'modal-remote','title'=> Yii::t('rbac','Create new rule'),'class'=>'btn btn-default']).
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>Yii::t('rbac','Reload Grid') ]).
                    '{toggleData}'.
                    '{export}'
                ],
            ],             
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => 'primary', 
                 'heading' => '<i class="glyphicon glyphicon-list"></i> '. $this->title,
                'before'=>'<em>'.Yii::t('rbac','* Resize table columns just like a spreadsheet by dragging the column edges.').'</em>',
                'after'=>false,
            ]
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrubModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
