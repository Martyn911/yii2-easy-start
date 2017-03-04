<?php
/**
 * @var $this yii\web\View
 */
use backend\assets\AppAsset;
use backend\widgets\Menu;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
$bundle = AppAsset::register($this);
?>
<?php $this->beginContent('@backend/views/layouts/base.php'); ?>
    <div class="wrapper">
        <!-- header logo: style can be found in header.less -->
        <header class="main-header">
            <a href="<?php echo Yii::getAlias('@backendUrl') ?>" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <?php echo Yii::$app->name ?>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only"><?php echo Yii::t('backend', 'Toggle navigation') ?></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li>
                            <?php echo Html::a('<i class="fa fa-external-link"></i> ' . Yii::t('backend', 'Go to frontend'), Yii::getAlias('@frontendUrl'), ['target' => '_blank'])?>
                        </li>
                        <?php if(Yii::$app->user->can('administrator')){ ?>
                            <!-- Notifications: style can be found in dropdown.less -->
                            <li id="log-dropdown" class="dropdown notifications-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-warning"></i>
                            <span class="label label-danger">
                                <?php echo \backend\models\SystemLog::find()->count() ?>
                            </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header"><?php echo Yii::t('backend', 'You have {num} log items', ['num' => \backend\models\SystemLog::find()->count()]) ?></li>
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu">
                                            <?php foreach(\backend\models\SystemLog::find()->orderBy(['log_time'=>SORT_DESC])->limit(5)->all() as $logEntry): ?>
                                                <li>
                                                    <a href="<?php echo Yii::$app->urlManager->createUrl(['/log/view', 'id'=>$logEntry->id]) ?>">
                                                        <i class="fa fa-warning <?php echo $logEntry->level == \yii\log\Logger::LEVEL_ERROR ? 'text-red' : 'text-yellow' ?>"></i>
                                                        <?php echo $logEntry->category ?>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                    <li class="footer">
                                        <?php echo Html::a(Yii::t('backend', 'View all'), ['/log/index']) ?>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>
                        <li class="dropdown lang lang-menu">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                                <span><?php echo Yii::t('common', 'Language'); ?> <i class="caret"></i></span>
                            </a>
                            <?php
                            echo \yii\bootstrap\Dropdown::widget([
                                'items' => array_map(function ($code) {
                                    $params = Yii::$app->requestedParams;
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
                            ]);
                            ?>
                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo \Yii::$app->user->identity->profile ? \Yii::$app->user->identity->profile->getAvatarUrl(25): '/images/ava.png'; ?>" class="user-image">
                                <span><?php echo Yii::$app->user->identity->username ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header light-blue">
                                    <img src="<?php echo \Yii::$app->user->identity->profile ? \Yii::$app->user->identity->profile->getAvatarUrl(90): '/images/ava.png'; ?>" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo Yii::$app->user->identity->username ?>
                                        <small>
                                            <?php echo Yii::t('backend', 'Member since {0, date, short}', Yii::$app->user->identity->created_at) ?>
                                        </small>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <?php echo Html::a(Yii::t('backend', 'Profile'), ['/user/settings/profile'], ['class' => 'btn btn-default btn-flat']) ?>
                                    </div>
                                    <div class="pull-left">
                                        <?php echo Html::a(Yii::t('backend', 'Account'), ['/user/settings/account'], ['class' => 'btn btn-default btn-flat']) ?>
                                    </div>
                                    <div class="pull-right">
                                        <?php echo Html::a(Yii::t('common', 'Logout'), ['/user/logout'], ['class' => 'btn btn-default btn-flat', 'data-method' => 'post']) ?>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?php echo \Yii::$app->user->identity->profile ? \Yii::$app->user->identity->profile->getAvatarUrl(45): '/images/ava.png'; ?>" class="img-circle" />
                    </div>
                    <div class="pull-left info">
                        <p><?php echo Yii::t('backend', 'Hello, {username}', ['username' => Yii::$app->user->identity->username]) ?></p>
                        <i class="fa fa-circle text-success"></i>
                        <?php echo Yii::$app->formatter->asDatetime(time(), 'short') ?>
                    </div>
                </div>
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <?php echo Menu::widget([
                    'options' => ['class' => 'sidebar-menu'],
                    'linkTemplate' => '<a href="{url}">{icon}<span>{label}</span>{right-icon}{badge}</a>',
                    'submenuTemplate'=>"\n<ul class=\"treeview-menu\">\n{items}\n</ul>\n",
                    'activateParents'=>true,
                    'items' => [
                        [
                            'label' => Yii::t('backend', 'Menu'),
                            'options' => ['class' => 'header']
                        ],
                        [
                            'label' => Yii::t('backend', 'Users'),
                            'icon' => '<i class="fa fa-users"></i>',
                            'url' => ['/user/admin/index'],
                            'visible' => Yii::$app->user->can('administrator')
                        ],
                        [
                            'label' => Yii::t('backend', 'Logs'),
                            'url' => ['/log/index'],
                            'icon' => '<i class="fa fa-warning"></i>',
                            'badge' => \backend\models\SystemLog::find()->count(),
                            'badgeBgClass' => 'label-danger',
                            'visible' => Yii::$app->user->can('administrator')
                        ],
                        [
                            'label' => Yii::t('backend', 'Tree menu'),
                            'url' => '#',
                            'icon' => '<i class="fa fa-angle-double-right"></i>',
                            'options' => ['class' => 'treeview'],
                            'items' => [
                                [
                                    'label' => 'New tree menu',
                                    'url' => ['#'],
                                    'icon' =>'<i class="fa fa-angle-double-right"></i>',
                                    'options' => ['class' => 'treeview'],
                                    'items' => [
                                        [
                                            'label' => 'Menu item',
                                            'url' => ['#'],
                                            'icon' => '<i class="fa fa-angle-double-right"></i>'
                                        ],
                                    ]
                                ],
                                [
                                    'label' => 'Menu item',
                                    'url' => ['#'],
                                    'icon' => '<i class="fa fa-angle-double-right"></i>'
                                ],
                            ]
                        ],
                    ]
                ]) ?>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Right side column. Contains the navbar and content of the page -->
        <aside class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <?php echo $this->title ?>
                    <?php if (isset($this->params['subtitle'])): ?>
                        <small><?php echo $this->params['subtitle'] ?></small>
                    <?php endif; ?>
                </h1>

                <?php echo Breadcrumbs::widget([
                    'tag' => 'ol',
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
            </section>

            <!-- Main content -->
            <section class="content">
                <?php if (Yii::$app->session->hasFlash('alert')):?>
                    <?php echo \yii\bootstrap\Alert::widget([
                        'body'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
                        'options'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
                    ])?>
                <?php endif; ?>
                <?php echo $content ?>
            </section><!-- /.content -->
        </aside><!-- /.right-side -->
    </div><!-- ./wrapper -->

<?php $this->endContent(); ?>