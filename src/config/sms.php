<?php
return [
    'access_key_id' => env('ALI_ACCESS_KEY_ID'),

    'access_key_secret' => env('ALI_ACCESS_KEY_SECRET'),

    'sign_group' => [
        'default' => env('ALI_SIGN')
    ],

    'template_group' => [
        'default' => env('ALI_TEMPLATE')
    ],

    //是否启用https
    'security'=> false,

    'region_id' => 'cn-hangzhou',

    'version'   => '2017-05-25',
];
