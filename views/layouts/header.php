<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">'.Html::img('@web/img/nebeng_icon1.png', ["class"=>"img-responsive", "alt"=>"logo mini"]).'</span><span class="logo-lg">' . Html::img('@web/img/nebeng5.png', ["class"=>"img-responsive", "style"=>"margin: 0 auto", "alt"=>"logo besar"]) . '</span>', ['/site/gotohome'], ['class' => 'logo', "data-method"=>"post"]) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                
                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= Yii::$app->request->baseUrl ?>/img/user.png" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?= Yii::$app->session->get('user.nebUsername'); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= Yii::$app->request->baseUrl ?>/img/user-256.png" class="img-circle"
                                 alt="User Image"/>

                            <p>
                                <?= Yii::$app->session->get('user.nebNama'); ?> - <?= Yii::$app->session->get('user.nebNPM'); ?>
                                <small><?= Yii::$app->session->get('user.nebId'); ?></small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <?= Html::a(
                                    'Profile <i class="fa fa-user"></i>',
                                    ['/site/profil'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Sign out <i class="fa fa-power-off"></i>',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</header>
