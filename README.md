yii2-rbac-plus
=============
[![Latest Stable Version](https://poser.pugx.org/johnitvn/yii2-rbac-plus/v/stable)](https://packagist.org/packages/johnitvn/yii2-rbac-plus)
[![License](https://poser.pugx.org/johnitvn/yii2-rbac-plus/license)](https://packagist.org/packages/johnitvn/yii2-rbac-plus)
[![Total Downloads](https://poser.pugx.org/johnitvn/yii2-rbac-plus/downloads)](https://packagist.org/packages/johnitvn/yii2-rbac-plus)
[![Monthly Downloads](https://poser.pugx.org/johnitvn/yii2-rbac-plus/d/monthly)](https://packagist.org/packages/johnitvn/yii2-rbac-plus)
[![Daily Downloads](https://poser.pugx.org/johnitvn/yii2-rbac-plus/d/daily)](https://packagist.org/packages/johnitvn/yii2-rbac-plus)

Database role base access control manager for yii2


Features
------------
+ CRUD operations for roles, permissions and rules
+ Allows to assign multiple roles to user
+ Nice views to intergrate right away
+ Integrated with [Yii2-user-plus](https://github.com/johnitvn/yii2-user-plus) - flexible user management module

<img src="http://s17.postimg.org/8p7idb9jz/screencapture_fastandfurious_dev_apps_test_user.png" alt="Yii2 RBAC manager" width="640">


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist johnitvn/yii2-rbac-plus "*"
```

or add

```
"johnitvn/yii2-rbac-plus": "*"
```

to the require section of your `composer.json` file.


Usage
-----
1. Let 's add into modules config in your main config file

````
'components' => [
    'authManager' => [
        'class' => 'yii\rbac\DbManager',
    ],
],
'modules' => [
    'rbac' =>  [
        'class' => 'johnitvn\rbacplus\Module'
    ]       
]
````

Next, update the database schema 

````
$ php yii migrate/up --migrationPath=@yii/rbac/migrations
````

Ok. That's done. Avaiable route now:

+ /rbac/rule
+ /rbac/permission
+ /rbac/role
+ /rbac/assignment

2. The module configuration avaible:

````
'modules' => [
    'rbac' =>  [
        'class' => 'johnitvn\rbacplus\Module',
        'userModelClassName'=>null,
        'userModelIdField'=>'id',
        'userModelLoginField'=>'username',
        'userModelLoginFieldLabel'=>null,
        'userModelExtraDataColumls'=>null,
        'beforeCreateController'=>null,
        'beforeAction'=>null
    ]       
]
````

+ <b>userModelClassName</b>: The user model class.<br>
 If you not set or set null, <b>RBAC Plus</b> will be get from `Yii::$app->getUser()->identityClass`
+ <b>userModelIdField</b>: The user model id field.<br>
 Default id field is 'id', you must set this config if primary key of user table in database is not 'id'
+ <b>userModelLoginField</b> The user model login field.<br>
 Default login field is 'username'. Maybe you use email field or something other for login. So you must change this config
+ <b>userModelLoginFieldLabel</b> The user model login field label.<br>
 If you set null the label will get from `$userModelClass->attributeLabels()[$userModelLoginField]`
+ <b>userModelExtraDataColumls</b> The extra data columns you want to show in user assign views.<br>
 The default in assignment data gridview just display id and login column data. if you want to add created_at column you can add
````php 
'userModelExtraDataColumls'=>[
    [
        'attributes'=>'created_at',
        'value'=>function($model){
            return date('m/d/Y', $model->created_at);
        }
    ]
]
````
+ <b>beforeCreateController</b> The callable before create all controller of <b>Rbac Plus</b> module.
The default it is null. You need config this when you want to restrict access to <b>Rbac Plus</b> module.<br>
Example:
````php
'beforeCreateController'=>function($route){
    /**
    *@var string $route The route consisting of module, controller and action IDs.
    */    
}
````
+ <b>beforeAction</b>The callable before action of all controller in <b>Rbac Plus</b> module.<BR>
The default it is null. You need config this when you want to restrict access to any action in some controller of <b>Rbac Plus</b> module <BR>
Example:
````php
'beforeAction'=>function($action){
    /**
    *@var yii\base\Action $action the action to be executed.
    */    
}
````
