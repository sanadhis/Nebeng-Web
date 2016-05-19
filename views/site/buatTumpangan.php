<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Buat Tumpangan';
$this->params['breadcrumbs'][] = $this->title;
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
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
							<input class="form-control" placeholder="Asal" type="text">
						</div>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Lokasi Tujuan</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-location-arrow"></i></span>
							<input class="form-control" placeholder="Tujuan" type="text">
						</div>
					</div>

					<!-- time Picker -->
					<div class="bootstrap-timepicker">
						<div class="form-group">
							<label>Jam Tumpangan Dimulai</label>

							<div class="input-group">
								<input type="text" class="form-control timepicker">

								<div class="input-group-addon">
									<i class="fa fa-clock-o"></i>
								</div>
							</div>
							<!-- /.input group -->
						</div>
						<!-- /.form group -->
					</div>

					<div class="form-group">
						<label>Kapasitas Tumpangan</label>
						<select class="form-control">
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
							<option>6</option>
							<option>7</option>
							<option>8</option>
						</select>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Keterangan</label>
						<input class="form-control" id="exampleInputEmail1" placeholder="Keterangan Tambahan, contoh: jenis kendaraan" type="text">
					</div>
					<div class="box-footer">
						<button type="submit" class="btn btn-warning">Buat Tumpangan Anda!</button>
					</div>



				</div><!--End box-body-->

			</div><!--End box-warning-->

		</div><!--End col-md-6-->

	</div><!--End row-->

</div>
