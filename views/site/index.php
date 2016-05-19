<?php

/* @var $this yii\web\View */

$this->title = 'Nebeng Web - Home';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Selamat Datang di Aplikasi Web Nebeng</h1>

        <p class="lead">Simak rangkuman platform kami!</p>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <img src="<?= Yii::$app->request->baseUrl ?>/img/icon-about.png" class="img-responsive" width="128px" style="margin: 0 auto;">
                <h2>Nebeng (Berbagi Tumpangan)</h2>

                <p>Berbagi Tumpangan merupakan aplikasi yang ditunjukkan untuk menjadi platform berbagi kendaraan secara efektif dan efisien. Aplikasi ini
                menjadi wadah untuk berbagi volume kendaraan pribadi ke pengguna jalan raya lain. Hal ini merupakan upaya untuk mewujudkan green transportation 
                system dengan mengurangi volume kendaraan di jalan raya (mengurangi penggunaan kendaraan pribadi).
                </p>

            </div>
            <div class="col-lg-4">
                <img src="<?= Yii::$app->request->baseUrl ?>/img/ui-logo.png" class="img-responsive" width="128px" style="margin: 0 auto;">
                <h2>Universitas Indonesia</h2>

                <p>Platform Berbagi Tumpangan ditunjukkan hanya untuk sivitas akademika Universitas Indonesia (Tenaga Pengajar, Staf, dan Mahasiswa).
                   Mengandalkan fitur SSO (single-sign-on) menggunakan akun JUITA UI, aplikasi ini dijamin aman karena pengguna aplikasi dipastikan adalah sivitas UI
                </p>

            </div>
            <div class="col-lg-4">
                <img src="<?= Yii::$app->request->baseUrl ?>/img/ime.jpg" class="img-responsive" width="96px" style="margin: 0 auto;">
                <h2>Teknik Komputer - DTE</h2>

                <p>Aplikasi dikembangkan dibawah naungan Departemen Teknik Elektro oleh Mahasiswa Teknik Komputer dan merupakan bagian dari kluster riset IoT serta project
                green.ui.ac.id
                </p>

            </div>
        </div>

    </div>
</div>
