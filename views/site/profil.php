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
					<h3 class="widget-user-username">Alexander Pierce</h3>
					<h5 class="widget-user-desc">Founder &amp; CEO</h5>
				</div>
				<div class="widget-user-image">
					<img class="img-circle" src="<?= Yii::$app->request->baseUrl ?>/img/profile-icon.png" alt="User Avatar">
				</div>
				<div class="box-footer">
					<div class="row">
						<div class="col-sm-4 border-right">
							<div class="description-block">
								<h5 class="description-header">3,200</h5>
								<span class="description-text">SALES</span>
							</div>
							<!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4 border-right">
							<div class="description-block">
								<h5 class="description-header">13,000</h5>
								<span class="description-text">FOLLOWERS</span>
							</div>
							<!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4">
							<div class="description-block">
								<h5 class="description-header">35</h5>
								<span class="description-text">PRODUCTS</span>
							</div>
							<!-- /.description-block -->
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
				</div>
			</div>
			<!-- /.widget-user -->
		</div>
	</div>
	
</div>
