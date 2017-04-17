<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php')//,
    //require(__DIR__ . '/params.php')
);

$config = [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'controllerMap' => [
                'security' => [
                    'class'  => 'dektrium\user\controllers\SecurityController',
                    'layout' => '@backend/views/layouts/base',
                ],
            ],
            // following line will restrict access to recovery, registration controllers from backend
            'as backend' => [
                'class' => 'dektrium\user\filters\BackendFilter',
                'controllers' => ['recovery', 'registration'],
            ]
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => env('backendCookieValidationKey'),
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],*/
        'urlManager' => [
            'class' => 'codemix\localeurls\UrlManager',
            'languages' => ['ru', 'en', 'uk'],
            //'enableLocaleUrls' => false;
            'enableDefaultLanguageUrlCode' => false,
            'enableLanguagePersistence' => true,
            'languageCookieName' => '_language',
            //'languageCookieOptions' => [],
            'languageSessionKey' => '_language',
            'ignoreLanguageUrlPatterns' => [
                // route pattern => url pattern
                //'#^user/#' => '#^user/#',
            ],
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [],
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views/security' => '@common/modules/user/views/admin/auth',
                    '@dektrium/user/views' => '@common/modules/user/views',
                ],
            ],
        ],

    ],
    'as beforeRequest' => [
        'class' => '\common\behaviors\GlobalAccessBehavior',
        'rules' => [
            [
                'controllers' => ['user/security'],
                'allow' => true,
                'roles' => ['?'],
            ],
            [
                'controllers'=>['site'],
                'allow' => true,
                'roles' => ['?', '@'],
                'actions'=>['error']
            ],
            [
                'controllers'=>['debug/default'],
                'allow' => true,
                'roles' => ['?'],
            ],
            [
                'controllers' => ['log'],
                'allow' => true,
                'roles' => ['administrator'],
            ],
            [
                'controllers' => ['log'],
                'allow' => false,
            ],
            [
                'allow' => true,
                'roles' => ['manager'],
            ]
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV && !YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*'],
        //'allowedIPs' => ['127.0.0.1', '::1', '192.168.1.*'],
    ];
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
