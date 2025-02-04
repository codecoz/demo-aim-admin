<?php

return [
    /* --------------------------------------------------------------------------------------------
     * Menu Configuration
     * --------------------------------------------------------------------------------------------
     */
    'menu_filters' => [
        CodeCoz\AimAdmin\MenuBuilder\Filters\HrefFilter::class,
        CodeCoz\AimAdmin\MenuBuilder\Filters\ActiveFilter::class,
        CodeCoz\AimAdmin\MenuBuilder\Filters\ClassesFilter::class,
    ],

    'menu' => [
        // Navbar items:
        [
            'text' => 'Dashboard',
            'icon' => 'ti ti-home',
            'url' => 'dashboard'
        ],

        [
            'text' => 'Product',
            'icon' => 'ti ti-list',
            'route' => 'product.list'
        ],


    ],

    /* --------------------------------------------------------------------------------------------
     * File Upload Configuration
     * --------------------------------------------------------------------------------------------
     */
    'upload_file_type' => ['png', 'jpg', 'bmp', 'pdf', 'doc', 'xls', 'ppt'],
    'upload_file_size' => 5 * 1024,

    /* --------------------------------------------------------------------------------------------
     * Auth Configuration
     * --------------------------------------------------------------------------------------------
     */
    'auth' => [
        'controller' => \CodeCoz\AimAdmin\Http\Controllers\Auth\LoginController::class,
        'user_model' => \App\Models\User::class,
        'url' => 'login',
        'logout_url' => 'logout',
        'profile_url' => 'profile',
        'middleware' => ['guest', 'web'],
    ],
    'registration' => [
        'controller' => \CodeCoz\AimAdmin\Http\Controllers\Auth\RegistrationController::class,
        'fields' => [
            'number' => 'id',
            'text' => 'full_name'
        ]
    ],
    'back_to_top' => true,
    'layout_class' => [
        'body' => 'text-sm',
        'brand' => '',
        'sidebar' => '',
        'navbar' => '',
        'footer' => '',
    ],
    'footer_text' => 'Anything you want',
    //Toast Time
    'flash-timer' => 2000,
    'show_toast_error' => true,
    'show_inline_alert_box' => true,
    'inline_validation_error' => true
];
