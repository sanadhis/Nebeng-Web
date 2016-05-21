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
					<h3 class="box-title">Lengkapi Detail Informasi Anda</h3>
				</div>

				<div class="box-body">
					<div class="form-group">
						<label for="exampleInputEmail1">Email Non-UI</label>
						<?= $form->field($model, 'email', ['template' => "<div class='input-group'>
							<span class='input-group-addon'><i class='fa fa-envelope-o'></i></span>
							\n{input}</div>\n{hint}\n{error}"])->textInput(array('placeholder' => 'Email')); ?>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">No. Handphone</label>
						<?= $form->field($model, 'noHP', ['template' => "<div class='input-group'>
							<span class='input-group-addon'><i class='fa fa-phone-square'></i></span>
							\n{input}</div>\n{hint}\n{error}"])->textInput(array('placeholder' => 'Nomor Handphone')); ?>
					</div>

					<div class="box-footer">
					<?= Html::submitButton('Perbaharui Informasi', ['class' => 'btn btn-success']) ?>
					</div>
					<?php ActiveForm::end() ?>



				</div><!--End box-body-->

			</div><!--End box-warning-->

		</div><!--End col-md-6-->
		
	</div><!--End row-->

</div>
