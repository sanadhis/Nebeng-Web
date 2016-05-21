<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Cari Tumpangan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    
    <?php
        if(empty($data)){
            echo "<h1>Belum ada tumpangan tersedia</h1>";
            echo "<h3>Anda harus menunggu sampai terdapat tumpangan yang tersedia</h3>";
        }
        else{
            echo "<h1>".Html::encode($this->title)."</h1>";
            echo "<ul class=\"timeline\">";
            foreach ($data as $result) {
                echo "
                <!-- timeline time label -->
                <li class=\"time-label\">
                    <span class=\"bg-red\">
                        $result[jam_berangkat]
                    </span>
                </li>
                <!-- /.timeline-label -->
                <li>
                    <!-- timeline icon -->
                    <i class=\"fa fa-car bg-yellow\"></i>
                    <div class=\"timeline-item\">
                        <span class=\"time\"><b>Waktu tumpangan: <i class=\"fa fa-clock-o\"></i> $result[jam_berangkat], $result[waktu_berangkat]</b></span>

                        <h3 class=\"timeline-header\"><b>$result[nama]</b>, Rute : $result[asal] <i class=\"fa fa-arrow-right\"></i> $result[tujuan]</h3>

                        <div class=\"timeline-body\">
                            <dl class=\"dl-horizontal\">
                                <dt>NPM Pengendara</dt>
                                <dd>: $result[npm] </dd>
                                <dt>Kapasitas Tumpangan</dt>
                                <dd>: $result[kapasitas] orang</dd>
                                <dt>Keterangan Tambahan</dt>
                                <dd>: $result[keterangan]</dd>
                            </dl>
                        </div>

                        <div class=\"timeline-footer\">".
                             Html::a('Tumpangi Kendaraan ini!', ['/site/numpang', 'id' => $result['id_tebengan']], ['class' => 'btn btn-success', 'data-method'=>'post']) 
                            ."Sisa Kapasitas : $result[sisa_kapasitas] orang
                        </div>
                    </div>
                </li>";
            }
            echo "<!-- timeline item -->
    
            <!-- END timeline item -->

            </ul>";
        }
    ?>

</div>
