<?php

$this->title = 'ویرایش مشخصات فایل اکسل';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'ته نشینی', 'url' => ['/process/ird/sedimentation']],
    ['label' => 'پایش', 'url' => ['/process/ird/sedimentation/manage/payesh']],
    ['label' => 'برنامه انتقال داده', 'url' => ['index']],
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
