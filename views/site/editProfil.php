<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Edit Profil';
$this->params['breadcrumbs'][] = $this->title;

$form = ActiveForm::begin([
    'id' => 'create-form',
])

?>
<div class="site-about">
	<h1><?= Html::encode($this->title) ?></h1>

	<div class="row">
		<div class="col-md-6">
			<div class="box box-warning">
				<div class="box-header with-border">
					<h3 class="box-title">Lengkapi Detail Tumpangan Anda</h3>
				</div>

				<div class="box-body">
					<div class="form-group">
						<label for="exampleInputEmail1">Lokasi Asal</label>
						<?= $form->field($model, 'asal', ['template' => "<div class='input-group'>
							<span class='input-group-addon'><i class='fa fa-map-marker'></i></span>
							\n{input}</div>\n{hint}\n{error}"])->textInput(array('placeholder' => 'Asal')); ?>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Lokasi Tujuan</label>
						<?= $form->field($model, 'tujuan', ['template' => "<div class='input-group'>
							<span class='input-group-addon'><i class='fa fa-location-arrow'></i></span>
							\n{input}</div>\n{hint}\n{error}"])->textInput(array('placeholder' => 'Tujuan')); ?>
					</div>

					<!-- time Picker -->
					<div class="bootstrap-timepicker">
						<div class="form-group">
							<label>Jam Tumpangan Dimulai</label>
								<?= $form->field($model, 'jamBerangkat', ['template' => "<div class='input-group'>
								\n{input}<div class='input-group-addon'><i class='fa fa-clock-o'></i></div></div>\n{hint}\n{error}"])->textInput(array('placeholder' => 'contoh: 11.10')); ?>
							<!-- /.input group -->
						</div>
						<!-- /.form group -->
					</div>

					<div class="form-group">
						<label>Kapasitas Tumpangan</label>
						<?= Html::activeDropDownList($model, 'kapasitas', ['1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8'], ['placeholder' => 'Keterangan Tambahan, contoh: jenis kendaraan', 'class' => 'form-control']); ?>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Keterangan</label>
						<?= $form->field($model, 'keterangan', ['template' => "{input}\n{hint}\n{error}"])->textInput(array('placeholder' => 'Keterangan Tambahan, contoh: jenis kendaraan')); ?>
					</div>
					<div class="box-footer">
					<?= Html::submitButton('Buat Tumpangan Anda!', ['class' => 'btn btn-warning']) ?>
					</div>
					<?php ActiveForm::end() ?>



				</div><!--End box-body-->

			</div><!--End box-warning-->

		</div><!--End col-md-6-->
		
	</div><!--End row-->

</div>
