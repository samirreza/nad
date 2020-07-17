<?php

$this->title = 'لیست فایلهای اکسل';
$this->params['breadcrumbs'] = [
    'فرایندها',
    'فرایند',
    ['label' => 'آر او', 'url' => ['/process/ird/ro/manage/index']],
    ['label' => 'پایش', 'url' => ['/process/ird/ro/manage/payesh']],
    'برنامه انتقال داده',
    $this->title
];

?>

<?= $this->render('@nad/common/modules/excelmanager/views/manage/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
