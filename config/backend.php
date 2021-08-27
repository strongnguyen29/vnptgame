<?php
return [
    'sidebar' => [
        [
            'type' => 'item',
            'title' => 'Dashboard',
            'icon' => 'fas fa-tachometer-alt',
            'route' => 'admin.dashboard'
        ],[
            'type' => 'item',
            'title' => 'Trang chủ',
            'icon' => 'fas fa-home',
            'route' => 'front.home'
        ],[
            'type' => 'header',
            'title' => 'NỘI DUNG'
        ],[
            'type' => 'treeview',
            'title' => 'Bài viết',
            'icon' => 'fas fa-file-alt',
            'items' => [
                [
                    'type' => 'item',
                    'title' => 'Danh sách',
                    'route' => 'admin.posts.index',
                    'gate' => 'list posts'
                ],
                [
                    'type' => 'item',
                    'title' => 'Thêm mới',
                    'route' => 'admin.posts.create',
                    'gate' => 'add posts'
                ],
                [
                    'type' => 'item',
                    'title' => 'Danh mục',
                    'route' => 'admin.posts.categories',
                    'routeData' => ['type' => \App\Models\Category::TYPE_POST],
                    'gate' => 'categories posts'
                ]
            ]
        ],[
            'type' => 'treeview',
            'title' => 'Tuyển dụng',
            'icon' => 'fas fa-address-card',
            'items' => [
                [
                    'type' => 'item',
                    'title' => 'Danh sách',
                    'route' => 'admin.recruitments.index',
                    'gate' => 'list recruitments'
                ],
                [
                    'type' => 'item',
                    'title' => 'Danh sách ứng tuyển',
                    'route' => 'admin.recruitments.applies',
                    'gate' => 'list recruitments'
                ],
                [
                    'type' => 'item',
                    'title' => 'Thêm mới',
                    'route' => 'admin.recruitments.create',
                    'gate' => 'add recruitments'
                ],
                [
                    'type' => 'item',
                    'title' => 'Danh mục',
                    'route' => 'admin.recruitments.categories',
                    'routeData' => ['type' => \App\Models\Category::TYPE_RECRUIT],
                    'gate' => 'categories recruitments'
                ],
            ]
        ],[
            'type' => 'header',
            'title' => 'TÀI KHOẢN'
        ],[
            'type' => 'item',
            'title' => 'Tài khoản',
            'icon' => 'fas fa-user',
            'route' => 'admin.users.index',
            'gate' => 'list users'
        ],[
            'type' => 'item',
            'title' => 'Nhóm tài khoản',
            'icon' => 'fas fa-users',
            'route' => 'admin.roles.index',
            'gate' => 'list roles'
        ],[
            'type' => 'header',
            'title' => 'CÀI ĐẶT'
        ],[
            'type' => 'item',
            'title' => 'Cài đặt chung',
            'icon' => 'fas fa-sliders-h',
            'route' => 'admin.options',
            'gate' => 'show options'
        ],[
            'type' => 'header',
            'title' => 'SYSTEM TOOLS'
        ],[
            'type' => 'item',
            'title' => 'Telescope',
            'icon' => 'fas fa-tools',
            'url' => '/telescope',
            'gate' => 'system-tools'
        ],
    ],

    'permissions' => [
        'users' => [
            'label' => 'Tài khoản',
            'actions' => ['list', 'add', 'edit', 'del']
        ],
        'roles' => [
            'label' => 'Nhóm tài khoản',
            'actions' => ['list', 'add', 'edit', 'del']
        ],
        'options' => [
            'label' => 'Cài đặt chung',
            'actions' => ['show', 'edit']
        ],
        'system-tools' => [
            'label' => 'System tools',
        ],
        'posts' => [
            'label' => 'Bài viết',
            'actions' => ['list', 'add', 'edit', 'publish', 'del', 'categories']
        ],
        'recruitments' => [
            'label' => 'Tuyển dụng',
            'actions' => ['list', 'add', 'edit', 'publish','del', 'categories']
        ],
    ]
];
