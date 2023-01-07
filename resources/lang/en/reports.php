<?php

return [
    'singular' => 'Report',
    'plural' => 'Reports',
    'empty' => 'There are no reports yet.',
    'count' => 'Reports Count.',
    'search' => 'Search',
    'select' => 'Select Report',
    'permission' => 'Manage reports',
    'trashed' => 'Trashed reports',
    'perPage' => 'Results Per Page',
    'filter' => 'Search for report',
    'actions' => [
        'list' => 'List All',
        'create' => 'Create a new report',
        'show' => 'Show report',
        'edit' => 'Edit report',
        'delete' => 'Delete report',
        'read' => 'Mark As Read',
        'unread' => 'Mark As Unread',
        'restore' => 'Restore',
        'forceDelete' => 'Delete Forever',
        'options' => 'Options',
        'save' => 'Save',
        'filter' => 'Filter',
    ],
    'messages' => [
        'sent' => 'The report has been sent successfully.',
        'deleted' => 'The report has been deleted successfully.',
        'restored' => 'The report has been restored successfully.',
    ],
    'attributes' => [
        'user_id' => 'User',
        'shop_order_id' => 'Order',
        'message' => 'Message',
        'read_at' => 'Read at',
        'read' => 'Read',
        'unread' => 'Unread',
    ],
    'dialogs' => [
        'delete' => [
            'title' => 'Warning !',
            'info' => 'Are you sure you want to delete the report ?',
            'confirm' => 'Delete',
            'cancel' => 'Cancel',
        ],
        'restore' => [
            'title' => 'Warning !',
            'info' => 'Are you sure you want to restore the report ?',
            'confirm' => 'Restore',
            'cancel' => 'Cancel',
        ],
        'forceDelete' => [
            'title' => 'Warning !',
            'info' => 'Are you sure you want to delete the report forever ?',
            'confirm' => 'Delete Forever',
            'cancel' => 'Cancel',
        ],
    ],
];
