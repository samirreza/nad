<?php

$this->title = 'افزودن فایل اکسل';
$this->params['breadcrumbs'] = [
    'مدیریت',
    'هماهنگی',
    ['label' => 'پایش', 'url' => ['/coordination/manage/payesh']],
    ['label' => 'برنامه انتقال داده', 'url' => ['index']],
    $this->title
];

?>

<div class="excel-file-create">
    <?= $this->render('@nad/common/modules/excelmanager/views/manage/_form', [
        'model' => $model,
    ]) ?>
</div>
