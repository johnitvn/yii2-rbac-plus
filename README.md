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
Let 's add into modules config in your main config file

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

Ok. That's done. Avaiable route now

+ /rbac/rule
+ /rbac/permission
+ /rbac/role
+ /rbac/assignment
