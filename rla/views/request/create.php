<?php

use nad\rla\models\RowLevelAccessRequest;

$this->title = 'درخواست جدید';
$this->params['breadcrumbs'] = [
    'درخواست دسترسی',
    $this->title
];

?>

<h2 class="nad-page-title">ایجاد درخواست</h2>

<div class="request-create">
    <?= $this->render('_form_create', [
        'model' => $model,
    ]) ?>
</div>