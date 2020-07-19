<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'مدیریت',
    'هماهنگی',
    ['label' => 'پایش', 'url' => ['/coordination/manage/payesh']],
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
