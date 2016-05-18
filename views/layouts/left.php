<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= Yii::$app->request->baseUrl ?>/img/graduation-school-hat.png" class="img-circle" alt="User Image"/>                
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Home', 'icon' => 'fa fa-compass', 'url' => ['/gii']],
                    ['label' => 'Cari Tumpangan', 'icon' => 'fa fa-universal-access', 'url' => ['/gii']],
                    ['label' => 'Buat Tumpangan', 'icon' => 'fa fa-taxi', 'url' => ['/debug']],
                    ['label' => 'Profil', 'icon' => 'fa fa-star-half-o', 'url' => ['/debug']],
                    ['label' => 'Log Out', 'icon' => 'fa fa-sign-out', 'url' => ['/debug']],
                ],
            ]
        ) ?>

    </section>

</aside>
