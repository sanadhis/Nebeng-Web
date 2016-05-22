<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<!-- Main content -->
<section class="content">

    <div class="site-about">

            <div class="error-content">
                <h3><?= $name ?></h3>

                <div class="info-box bg-red">
                    <span class="info-box-icon"><i class="fa fa-warning text-white"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Halaman yang anda cari tidak ditemukan</span>
                      <span class="info-box-number">Mohon gunakan panel menu di sebelah kiri halaman</span>

                          <span class="progress-description">
                            Panel akan membantu anda berpindah halaman
                          </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>

        </div>
    </div>
</section>
