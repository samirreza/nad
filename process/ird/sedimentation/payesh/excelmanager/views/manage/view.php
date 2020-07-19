<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'ته نشینی', 'url' => ['/process/ird/sedimentation']],
    ['label' => 'پایش', 'url' => ['/process/ird/sedimentation/manage/payesh']],
    ['label' => 'برنامه انتقال داده', 'url' => ['index']],
    $this->title
];

?>

<div class="excel-file-view">
    <?= $this->render('@nad/common/modules/excelmanager/views/manage/view', [
        'model' => $model,
        'dataProvider' => $dataProvider,
        'columns'=>$columns
    ]) ?>
</div>
