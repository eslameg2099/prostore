<?php

return [
    'singular' => 'بنرات',
    'plural' => 'بنرات',
    'children' => 'الاقسام الفرعية',
    'products' => 'منتجات ال:category',
    'empty' => 'لا يوجد بنر حتى الان',
    'count' => 'عدد البنرات',
    'search' => 'بحث',
    'select' => 'اختر القسم',
    'subcategory' => 'القسم الفرعي',
    'select-subcategory' => 'اختر القسم الفرعي',
    'permission' => 'ادارة الاقسام',
    'trashed' => 'الاقسام المحذوفة',
    'perPage' => 'عدد النتائج بالصفحة',
    'filter' => 'ابحث عن بنر',
    'actions' => [
        'list' => 'عرض الكل',
        'create-subcategory' => 'اضافة قسم فرعي',
        'create' => 'اضافة بنر',
        'show' => 'عرض بنر',
        'edit' => 'تعديل بنر',
        'delete' => 'حذف بنر',
        'restore' => 'استعادة',
        'forceDelete' => 'حذف نهائي',
        'options' => 'خيارات',
        'save' => 'حفظ',
        'filter' => 'بحث',
    ],
    'messages' => [
        'created' => 'تم اضافة البنر بنجاح.',
        'updated' => 'تم تعديل البنر بنجاح.',
        'deleted' => 'تم حذف البنر بنجاح.',
        'restored' => 'تم استعادة القسم بنجاح.',
    ],
    'attributes' => [
        'id' => 'رقم البنر',
        
        'slidertable_id' => 'رقم المعلن',
        'slidertable_type' => 'نوع المعلن',
        'stauts' => 'الحالة',
        'created_at' => 'تاريخ الاضافة',
        'image_web' => ' ويب',
        'image_phone' => 'موبيل',
    ],
    'dialogs' => [
        'delete' => [
            'title' => 'تحذير !',
            'info' => 'هل انت متأكد انك تريد حذف البنر؟',
            'confirm' => 'حذف',
            'cancel' => 'الغاء',
        ],
        'restore' => [
            'title' => 'تحذير !',
            'info' => 'هل انت متأكد انك تريد استعادة القسم ؟',
            'confirm' => 'استعادة',
            'cancel' => 'الغاء',
        ],
        'forceDelete' => [
            'title' => 'تحذير !',
            'info' => 'هل انت متأكد انك تريد حذف القسم نهائياً ؟',
            'confirm' => 'حذف نهائي',
            'cancel' => 'الغاء',
        ],
    ],
];
