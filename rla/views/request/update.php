<?php

$this->title = 'ویرایش درخواست';
$this->params['breadcrumbs'] = [
    'لیست درخواستها',
    $this->title
];

?>

<h2 class="nad-page-title">تایید/رد درخواست</h2>

<div class="request-update">
    <?= $this->render('_form_update', [
        'model' => $model,
    ]) ?>
</div>