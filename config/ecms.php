<?php


/**
 * 企业版CMS配置
 */
return [

    //sidebar menu
    'sidebar' => [
        /*[
            'name' => '开发演示',
            'icon' => 'fa-paper-plane',
            'child_icon' => 'fa-file-o',
            'sub_menu' => [
                [
                    'name' => '表单',
                    'route' => 'admin:demo.form',
                    'can' => '',
                ],
                [
                    'name' => '图标',
                    'route' => 'admin:demo.icon',
                    'can' => '',
                ],
                [
                    'name' => '更多',
                    'route' => 'https://almsaeedstudio.com/',
                    'can' => '',
                ],
            ],
        ],*/
        
        /*[
            'name' => '订单管理',
            'icon' => 'fa-paper-plane',
            'child_icon' => 'fa-file-o',
            'sub_menu' => [
                [
                    'name' => '表单',
                    'route' => 'admin:demo.form',
                    'can' => '',
                ],
                [
                    'name' => '图标',
                    'route' => 'admin:demo.icon',
                    'can' => '',
                ],
                [
                    'name' => '更多',
                    'route' => 'https://almsaeedstudio.com/',
                    'can' => '',
                ],
            ],
        ],*/
        
        [
            'name' => '资料库管理',
            'icon' => 'fa-folder',
            'nav_id' => 2,
            'child_icon' => '',
            'sub_menu' => [
                [
                    'name' => '资料分类',
                    'route' => 'admin:category.index',
                    'nav_id' => '',
                    'can' => '',
                ],
                [
                    'name' => '车主手册列表',
                    'nav_id' => 3,
                    'route' => 'admin:carowner.3',
                    'can' => '',
                ],
                [
                    'name' => '维修手册列表',
                    'nav_id' => 4,
                    //'route' => 'admin:ziliao.index.4',
                    'route' => 'admin:carowner.4',
                    'can' => '',
                ],
                
            ],
        ],

        [
            'name' => '保养项目管理',
            'icon' => 'fa-heart',
            'nav_id' => 5,
            'child_icon' => '',
            'sub_menu' => [
                [
                    'name' => '发动机空滤更换',
                    'nav_id' => 5,
                    'route' => 'admin:carowner.5',
                    'can' => '',
                ],
                [
                    'name' => '发动机机油更换',
                    'nav_id' => 6,
                    'route' => 'admin:carowner.6',
                    'can' => '',
                ],
                [
                    'name' => '空调滤芯更换',
                    'nav_id' => 7,
                    'route' => 'admin:carowner.7',
                    'can' => '',
                ],
                
            ],
        ],
        

         [
            'name' => '维修项目管理',
            'icon' => 'fa-user-plus',
            'nav_id' => 8,
            'child_icon' => '',
            'sub_menu' => [
                [
                    'name' => '节气门匹配',
                    'nav_id' => 9,
                    'route' => 'admin:carowner.9',
                    'can' => '',
                ],
                [
                    'name' => '胎压监测复位',
                    'nav_id' => 10,
                    'route' => 'admin:carowner.10',
                    'can' => '',
                ],
                [
                    'name' => '防盗/钥匙匹配',
                    'nav_id' => 11,
                    'route' => 'admin:carowner.11',
                    'can' => '',
                ],
                 [
                    'name' => 'ADAS标定',
                    'nav_id' => 12,
                    'route' => 'admin:carowner.12',
                    'can' => '',
                ],
                
            ],
        ],


        [
            'name' => '软件库管理',
            'icon' => 'fa-automobile',
            'child_icon' => 'fa-file-o',
            'sub_menu' => [

                [
                    'name' => '软件分类',
                    'route' => 'admin:soft',
                    'can' => '',
                ],
                [
                    'name' => '软件列表',
                    'route' => 'admin:softarticle',
                    'can' => '',
                ],
                /*[
                    'name' => '表单',
                    'route' => 'admin:demo.form',
                    'can' => '',
                ],
                [
                    'name' => '图标',
                    'route' => 'admin:demo.icon',
                    'can' => '',
                ],
                [
                    'name' => '更多',
                    'route' => 'https://almsaeedstudio.com/',
                    'can' => '',
                ],*/
            ],
        ],
        [
            'name' => '会员管理',
            'icon' => 'fa-user',
            'child_icon' => '',
            'sub_menu' => [
                [
                    'name' => '会员列表',
                    'route' => 'admin:member.index',
                    'can' => '',
                ],
               /* [
                    'name' => '图标',
                    'route' => 'admin:demo.icon',
                    'can' => '',
                ],
                [
                    'name' => '更多',
                    'route' => 'https://almsaeedstudio.com/',
                    'can' => '',
                ],*/
            ],
        ],
        
        /*[
            'name' => '内容管理',
            'icon' => 'fa-edit',
            'child_icon' => 'fa-star-o',
            'sub_menu' => [
                [
                    'name' => '分类',
                    'route' => 'admin:category.index',
                    'can' => '@category',
                ],
                [
                    'name' => '文章',
                    'route' => 'admin:article.index',
                    'can' => '@article',
                ],
            ],
        ],*/
    ],

    //各模型推荐位
    'flag' => [

        //文章模型推荐位
        'articles' => [
            'l' => '链接',
            'f' => '幻灯',
            's' => '滚动',
            'h' => '热门',
            't' => '置顶',
        ],

    ],
    //语言选择
    'language' => [
        1 => '中文',
        2 => '英文'
    ],
];