<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'کارتریج', 'url' => ['/process/ird/cartridge/payesh/excelmanager/manage/index']],
    ['label' => 'لیست فایلهای اکسل', 'url' => ['index']],
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
