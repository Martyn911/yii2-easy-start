<?php
$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/test.php'),
    require(__DIR__ . '/main.php'),
    [
        'id' => 'app-frontend-tests',
        'components' => [
            'assetManager' => [
                'basePath' => __DIR__ . '/../web/assets',
            ],
        ],
    ],
    [
    ]
);

return $config;
