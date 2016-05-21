<?php
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;

?>
<div class="content-wrapper">
    <!-- doesn't necessary needed
    <section class="content-header">
        <?=
        Breadcrumbs::widget(
            [
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]
        ) ?>
    </section>
    -->
    <section class="content">
        <?= Alert::widget() ?>
        <?= $content ?>
    </section>
</div>

<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2016 <a href="https://id.linkedin.com/in/sanadhisutandi">Nebeng's Dev</a>,<a href="http://almsaeedstudio.com">Admin LTE Template</a>.</strong> All rights
    reserved.
</footer>