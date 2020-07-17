<?php

$this->title = 'افزودن فایل اکسل';
$this->params['breadcrumbs'] = [
    'فرایندها',
    'فرایند',
    ['label' => 'آر او', 'url' => ['/engineering/piping/stage/payesh/excelmanager/manage/index']],
    ['label' => 'پایش', 'url' => ['/engineering/piping/stage/payesh/manage/index']],
    'برنامه انتقال داده',
    $this->title
];

?>

<div class="excel-file-create">
    <?= $this->render('@nad/common/modules/excelmanager/views/manage/_form', [
        'model' => $model,
    ]) ?>
</div>
