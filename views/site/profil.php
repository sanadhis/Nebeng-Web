<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Your Profile';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
	<h1><?= Html::encode($this->title) ?></h1>

	<div class="row">
		<div class="col-md-4">
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

		</div>
	</div>
	<?= Html::a('Edit Profile Anda', ['/site/editprofil'], ['class' => 'btn btn-success btn-lg', "data-method"=>"post"]) ?>
	
</div>
