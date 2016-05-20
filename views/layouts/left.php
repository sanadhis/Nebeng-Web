<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= Yii::$app->request->baseUrl ?>/img/graduation-school-hat.png" class="img-circle" alt="User Image"/>                
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->session->get('user.nebNama'); ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> <?= Yii::$app->session->get('user.nebRole'); ?></a>
            </div>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Home', 'icon' => 'fa fa-compass', 'url' => ['site/gotohome']],
                    ['label' => 'Cari Tumpangan', 'icon' => 'fa fa-universal-access', 'url' => ['site/caritumpangan']],
                    ['label' => 'Buat Tumpangan', 'icon' => 'fa fa-taxi', 'url' => ['site/buattumpangan']],
                    ['label' => 'Profil Anda', 'icon' => 'fa fa-star-half-o', 'url' => ['site/profil']],
                    ['label' => 'Log Out', 'icon' => 'fa fa-sign-out', 'template' => '<a href="{url}" data-method="post">{icon} {label}</a>', 'url' => ['/site/logout']],
                ],
            ]
        ) ?>

    </section>

</aside>
