<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Buat Tumpangan';
$this->params['breadcrumbs'][] = $this->title;

$form = ActiveForm::begin([
    'id' => 'create-form',
])

?>
<div class="site-about">

	  <div class="callout <?= $callout ?>">
        <h3><?= $title ?></h3>

        <h4><?= $subTitle ?></h4>
      </div>
	
	
	

</div>
