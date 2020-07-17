<?php

$this->title = 'افزودن فایل اکسل';
$this->params['breadcrumbs'] = [
    'فرایندها',
    'فرایند',
    ['label' => 'کارتریج', 'url' => ['/process/ird/cartridge/manage/index']],
    ['label' => 'پایش', 'url' => ['/process/ird/cartridge/manage/payesh']],
    'برنامه انتقال داده',
    $this->title
];

?>

<div class="excel-file-create">
    <?= $this->render('@nad/common/modules/excelmanager/views/manage/_form', [
        'model' => $model,
    ]) ?>
</div>
