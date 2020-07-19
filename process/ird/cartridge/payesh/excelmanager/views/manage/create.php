<?php

$this->title = 'افزودن فایل اکسل';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'کارتریج', 'url' => ['/process/ird/cartridge']],
    ['label' => 'پایش', 'url' => ['/process/ird/cartridge/manage/payesh']],
    ['label' => 'برنامه انتقال داده', 'url' => ['index']],
    $this->title
];

?>

<div class="excel-file-create">
    <?= $this->render('@nad/common/modules/excelmanager/views/manage/_form', [
        'model' => $model,
    ]) ?>
</div>
