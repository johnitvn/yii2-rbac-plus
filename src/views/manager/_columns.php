<?php
use yii\helpers\Url;

$columns = [
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'id',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'login',
    ],
];


$extraColums = \Yii::$app->getModule('rbac')->userModelExtraDataColumls;
if ($extraColums !== null) {
    // If extra colums exist merge and return 
    $columns = array_merge($columns, $extraColums);
}
$columns[] = [
    'class' => 'kartik\grid\ActionColumn',
    'template'=>'{update}',
    'header'=>'Assignment',
    'dropdown' => false,
    'vAlign' => 'middle',
    'urlCreator' => function($action, $model, $key, $index) {
        return Url::to([$action, 'id' => $key]);
    }, 
    'updateOptions' => [
        'role' => 'modal-remote',
        'title' => 'Update',
        'data-toggle' => 'tooltip'
    ],    
];
return $columns;


        