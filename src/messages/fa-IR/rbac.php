<?php

return [
    /* =========== Controller common  =============*/
    'Create new {0}' => 'ایجاد {0} جدید',
    'Have been create new {0} success' => '{0} جدید با موفقیت ساخته شد',
    'Update {0}' => 'بروزرسانی {0}',
    'Have been update {0} success' => 'بروزرسانی {0} با موفقیت انجام شد',
    'The requested page does not exist.'=>'صفحه ی درخواستی شما وجود ندارد',
   
    /* =========== Views common  =============*/
    /* 1. GridView */
    '* Resize table columns just like a spreadsheet by dragging the column edges.' => '  * میتوانید اندازه ی ستون ها را تغییر دهید.', // for toolbar buttons
    'Reload Grid' => 'بازنشانی جدول', // for toolbar buttons
    'All' => 'همه', // for toolbar buttons
    'Show all data' => 'نمایش همه ی اطلاعات', // for toolbar buttons
    'Page' => 'صفحه', // for toolbar buttons
    'Show first page data' => 'نمایش اطلاعات صفحه ی اول', // for action buttons
    'View'=>'نمایش',
    'Update' => 'بروزرسانی', // for action buttons
    'Delete' => 'حذف', // for action buttons
    /*2. Modal*/
    'Close'=>'بستن',
    'Save'=>'ذخیره',
    'Edit'=>'ویرایش',
    'Ok'=>'فهمیدم',
    'Cancel'=>'لغو',
    'Create More'=>'ایجاد موارد بیشتر',
    'Are you sure?'=>'برای این کار اطمینان دارید؟',// for confirm delete
    'Are you sure want to delete this item'=>'آیا برای حذف این مورد اطمینان دارید؟',// for confirm delete
    '(not use)'=>'(استفاده نشده)',
  
    /* =========== Auth Item Model  =============*/
    'Name'=>'نام',
    'Description'=>'توضیحات',
    'Rule Name'=>'نام قائده',
    'Data'=>'اطلاعات',
    'Rule not exists'=>'این قائده وجود ندارد',
    
    
       /* =========== Rule Manager  =============*/
    /* 1. Rule Model */
    'Rule Name' => 'نام قائده',// Rule Model
    'Class Name'=>'نام کلاس',// Rule Model
    'Class "{className}" not exist'=>'کلاس "{className}" وجود ندارد',
    'Class "{className}" must extends yii\rbac\Rule'=>'Class "{className}" must extends yii\rbac\Rule',
    'The "{className}::\$name" is not set'=>'The "{className}::\$name" is not set',
    'The "{className}::\$name" is incorrect with the name of rule you have set'=>'The "{className}::\$name" is incorrect with the name of rule you have set',
  
    
     /* 2. Rule Views */  
    'Rules Manager' => 'مدیریت قوائد',
       
    
    /* =========== Permisstion Manager  =============*/
    /* 1. Permisstion Model */
    'Permission name'=>'نام دسترسی',
    
    /* 2. Permisstion Views */  
    'Permisstions Manager'=>'مدیریت دسترسی ها',
    
    
    /* =========== Permisstion Manager  =============*/
    /* 1. Permisstion Model */
    'Role name'=>'نام نقش',
    
    /* 2. Permisstion Views */  
    'Roles Manager'=>'مدیریت نقش ها',

    /* =========== User role assignemnt  =============*/
    /* 1. Permisstion Views */      
    'User Assignment'=>'وظیفه کاربر',
    'Assignment'=>'وظیفه',

    'A role represents a collection of permissions (e.g. creating posts, updating posts). A role may be assigned to one or multiple users. To check if a user has a specified permission, we may check if the user is assigned with a role that contains that permission.'=>'<span class="glyphicon glyphicon-question-sign"></span> '.'یک نقش مجموعه ای از مجوز ها را نشان می دهد (به عنوان مثال ایجاد پست ها، به روز رسانی پست ها). یک نقش ممکن است به یک یا چند کاربر اختصاص داده شود. برای بررسی اینکه آیا یک کاربر دارای مجوز مشخص است، ما ممکن است بررسی کنیم که آیا کاربر نقشی که حاوی آن مجوز است را دارد یا خیر!',
    'Associated with each role or permission, there may be a rule. A rule represents a piece of code that will be executed during access check to determine if the corresponding role or permission applies to the current user. For example, the "update post" permission may have a rule that checks if the current user is the post creator. During access checking, if the user is NOT the post creator, he/she will be considered not having the "update post" permission.'
    =>
        '<span class="glyphicon glyphicon-question-sign"></span> '.'همراه با هر نقش و یا اجازه، ممکن است یک قاعده وجود داشته باشد. یک قانون نشان دهنده یک تکه از کد است که در هنگام بررسی دسترسی اجرا می شود تا تعیین شود که آیا نقش یا مجوز مربوطه برای کاربر فعلی اعمال می شود یا خیر. به عنوان مثال، مجوز "به روز رسانی یک پست" ممکن است یک قانون داشته باشد که بررسی کند که آیا کاربر فعلی خالق پست است؟ در حین چک کردن دسترسی، اگر کاربر خالق پست باشد، وی برای مجوز "بروزرسانی پست" در نظر گرفته نخواهد شد.',
    'Both roles and permissions can be organized in a hierarchy. In particular, a role may consist of other roles or permissions; and a permission may consist of other permissions. Yii implements a partial order hierarchy which includes the more special tree hierarchy. While a role can contain a permission, it is not true vice versa.'
    =>
        '<span class="glyphicon glyphicon-question-sign"></span> '.'هر دو تنظیم نقش و مجوز را می توان به صورت سلسله مراتبی سازماندهی کرد. به طور خاص، نقش ممکن است از نقش ها یا مجوز های دیگر باشد؛ و مجوز ممکن است از سایر مجوزها باشد. سیستم یک سلسله مراتب نظم جزئی را اجرا می کند که شامل سلسله مراتب درختی خاص است. در حالی که یک نقش میتواند حاوی یک مجوز باشد، اما برعکس آن صدق نکند.'
];

