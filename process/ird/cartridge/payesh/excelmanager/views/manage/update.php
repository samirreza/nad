<?php

$this->title = 'ویرایش مشخصات فایل اکسل';
$this->params['breadcrumbs'] = [
    'فرایندها',
    'فرایند',
    ['label' => 'کارتریج', 'url' => ['/process/ird/cartridge/manage/index']],
    ['label' => 'پایش', 'url' => ['/process/ird/cartridge/manage/payesh']],
    'برنامه انتقال داده',
    ['label' => $model->title, 'url' => ['view', 'id' => $model->id]],
    $this->title
];

?>

<div class="excel-file-update">
    <?= $this->render('@nad/common/modules/excelmanager/views/manage/_form', [
        'model' => $model,
        'dataProvider' => $dataProvider,
        'columns' => $columns
    ]) ?>
</div>
