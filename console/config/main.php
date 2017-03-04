<?php
$config = [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'controllerMap' => [
        'fixture' => [
            'class' => 'yii\console\controllers\FixtureController',
            'namespace' => 'common\fixtures',
        ],
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => '@common/migrations',
            'migrationTable' => '{{%migrations}}'
        ],
    ],
    'modules' => [
        'rbac' => 'dektrium\rbac\RbacConsoleModule',
    ],
    'components' => [],
    'params' => array_merge(
        require(__DIR__ . '/../../common/config/params.php'),
        [

        ]
    ),
];

if (YII_ENV_DEV) {
    $config = yii\helpers\ArrayHelper::merge(
        $config,
        [
            'bootstrap' => ['gii'],
            'modules' => [
                'gii' => 'yii\gii\Module',
            ],
        ]
    );
}

return $config;
