<?php

$this->title = 'ویرایش مشخصات فایل اکسل';
$this->params['breadcrumbs'] = [
    'موقت',
    'تامین',
    ['label' => 'واحد 1', 'url' => ['/temporary/supply/unit1/manage/index']],
    ['label' => 'لیست فایهای اکسل', 'url' => ['index']],
    ['label' => $model->title, 'url' => ['view', 'id' => $model->id]],
    $this->title
];

?>

<div class="excel-file-update">
    <?= $this->render('@nad/common/modules/excelmanager/views/manage/_form', [
        'model' => $model
    ]) ?>
</div>
