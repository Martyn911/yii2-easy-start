<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Yii2 easy start',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => Yii::t('common', 'Home'), 'url' => ['/site/index']],
        ['label' => Yii::t('frontend', 'About'), 'url' => ['/site/about']],
        ['label' => Yii::t('frontend', 'Contact'), 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => Yii::t('common', 'Signup'), 'url' => ['/user/register']];
        $menuItems[] = ['label' => Yii::t('common', 'Login'), 'url' => ['/user/login']];
    } else {
        $menuItems[] = [
            'label' => Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->username,
            'visible'=>!Yii::$app->user->isGuest,
            'items'=>[
                [
                    'label' => Yii::t('common', 'Settings'),
                    'url' => ['/user/settings/profile']
                ],
                [
                    'label' => Yii::t('frontend', 'Backend'),
                    'url' => Yii::getAlias('@backendUrl'),
                    'visible'=>Yii::$app->user->can('manager'),
                    'linkOptions' => ['target' => '_blank']
                ],
                [
                    'label' => Yii::t('common', 'Logout'),
                    'url' => ['/user/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ]
            ]
        ];
    }

    $menuItems[] = [
        'label' => Yii::t('common', 'Language'),
        'items' => array_map(function ($code) {
            $params = Yii::$app->request->queryParams;
            array_unshift($params, '/' . Yii::$app->controller->route);
            $labels = [
                'en' => Yii::t('common', 'English'),
                'ru' => Yii::t('common', 'Русский'),
                'uk' => Yii::t('common', 'Українська'),
            ];

            $params['language'] = $code;
            return [
                'label' => $labels[$code],
                'url' => $params,
                'visible' => strtolower(Yii::$app->language) !== strtolower($code)
            ];
        }, Yii::$app->getUrlManager()->languages)
    ];

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);

    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?php echo Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Yii2 easy start <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
