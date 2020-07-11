<?php

$this->title = 'افزودن فایل اکسل';
$this->params['breadcrumbs'] = [
    'موقت',
    'تامین',
    ['label' => 'واحد 1', 'url' => ['/temporary/supply/unit1/manage/index']],
    'برنامه فایل اکسل',
    $this->title
];

?>

<div class="excel-file-create">
    <?= $this->render('@nad/common/modules/excelmanager/views/manage/_form', [
        'model' => $model,
    ]) ?>
</div>
