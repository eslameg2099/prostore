<?php

return [
    'plural' => 'المسئولين',
    'singular' => 'المسئول',
    'empty' => 'لا توجد مسئولين',
    'select' => 'اختر المسئول',
    'trashed' => 'المسئولين المحذوفين',
    'perPage' => 'عدد النتائج في الصفحة',
    'actions' => [
        'list' => 'كل المسئولين',
        'show' => 'عرض',
        'create' => 'إضافة',
        'new' => 'إضافة',
        'edit' => 'تعديل  المسئول',
        'delete' => 'حذف المسئول',
        'restore' => 'استعادة',
        'forceDelete' => 'حذف نهائي',
        'save' => 'حفظ',
        'filter' => 'بحث',
    ],
    'messages' => [
        'created' => 'تم إضافة المسئول بنجاح .',
        'updated' => 'تم تعديل المسئول بنجاح .',
        'deleted' => 'تم حذف المسئول بنجاح .',
        'restored' => 'تم استعادة المسئول بنجاح .',
'deletedata'=>'تم حذف الداتا بنجاح',
    ],
    'attributes' => [
        'name' => 'اسم المسئول',
        'phone' => 'رقم الهاتف',
        'email' => 'البريد الالكترونى',
        'created_at' => 'تاريخ الإنضمام',
        'old_password' => 'كلمة المرور القديمة',
        'password' => 'كلمة المرور',
        'password_confirmation' => 'تأكيد كلمة المرور',
        'type' => 'نوع المستخدم',
        'avatar' => 'الصورة الشخصية',
'fulladd'=>'العنوان بالكامل',
    ],
    'dialogs' => [
        'delete' => [
            'title' => 'تحذير !',
            'info' => 'هل أنت متأكد انك تريد حذف هذا المسئول ؟',
            'confirm' => 'حذف',
            'cancel' => 'إلغاء',
        ],
        'restore' => [
            'title' => 'تحذير !',
            'info' => 'هل أنت متأكد انك تريد استعادة هذا المسئول ؟',
            'confirm' => 'استعادة',
            'cancel' => 'إلغاء',
        ],
        'forceDelete' => [
            'title' => 'تحذير !',
            'info' => 'هل أنت متأكد انك تريد حذف هذا المسئول نهائياً؟',
            'confirm' => 'حذف نهائي',
            'cancel' => 'إلغاء',
        ],
    ],
];
