<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Your Profile';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
	<h1><?= Html::encode($this->title) ?></h1>

	<div class="row">
		<div class="col-md-5">
			<!-- Widget: user widget style 1 -->
			<div class="box box-widget widget-user">
				<!-- Add the bg color to the header using any of the bg-* classes -->
				<div class="widget-user-header bg-yellow-active">
					<h3 class="widget-user-username"><?= Yii::$app->session->get('user.nebNama'); ?></h3>
					<h5 class="widget-user-desc"><?= Yii::$app->session->get('user.nebEmail'); ?></h5>
				</div>
				<div class="widget-user-image">
					<img class="img-circle" src="<?= Yii::$app->request->baseUrl ?>/img/profile-icon.png" alt="User Avatar">
				</div>
				<div class="box-footer">
					<div class="row">
						<div class="col-sm-4 border-right">
							<div class="description-block">
								<h5 class="description-header">Role</h5>
								<span class="description-text"><?= Yii::$app->session->get('user.nebRole'); ?></span>
							</div>
							<!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4 border-right">
							<div class="description-block">
								<h5 class="description-header">NPM</h5>
								<span class="description-text"><?= (Yii::$app->session->get('user.nebNPM')); ?></span>
							</div>
							<!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4">
							<div class="description-block">
								<h5 class="description-header">Username</h5>
								<span class="description-text"><?= Yii::$app->session->get('user.nebUsername'); ?></span>
							</div>
							<!-- /.description-block -->
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
				</div>
			</div>
			<!-- /.widget-user -->

			<div class="box box-warning">
	            <div class="box-header with-border">
	              <h3 class="box-title">Informasi</h3>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body">
	              <strong><i class="fa fa-envelope margin-r-5"></i> Email Non-UI</strong>

	              <p class="text-muted">
	              	<?php
	              		if($data) echo $data->email;
	              	?>
	              </p>

	              <hr>

	              <strong><i class="fa fa-phone-square margin-r-5"></i> No. Handphone</strong>

	              <p class="text-muted">
	              	<?php
	              		if($data) echo $data->no_handphone;
	              	?>
	              </p>

	            </div>
	            <!-- /.box-body -->
	        </div>
	        <?= Html::a('Edit Profile Anda', ['/site/editprofil'], ['class' => 'btn btn-success btn-lg', "data-method"=>"post"]) ?>
		</div><!-- end col-md-5 -->

		<div class="col-md-6">
			<div class="box box-warning">
				<div class="box-header with-border">
					<h3 class="box-title">Informasi Tumpangan/Menumpang Anda</h3>
				</div>

				<div class="box-body">
					<h4><?= $title ?></h4>

						<?php
					        if (!empty($infoTumpangan)){
					            echo "<ul class=\"timeline\">";
					            	foreach ($infoTumpangan as $result) {
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

					                        <h3 class=\"timeline-header\">A/N: <b>$result[nama]</b>,<br>Rute : $result[asal] <i class=\"fa fa-arrow-right\"></i> $result[tujuan]</h3>

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

					                        <div class=\"timeline-footer\">
					               			Sisa Kapasitas : $result[sisa_kapasitas] orang
					                        </div>
					                    </div>
					                </li>";
					            	}
					            echo "<!-- timeline item -->
					    
					            <!-- END timeline item -->

					            </ul>";
					        }
						?>
				</div><!--end box body-->

			</div><!--end box success -->

		</div><!--end col md 6-->
	</div>
	
	
</div>
