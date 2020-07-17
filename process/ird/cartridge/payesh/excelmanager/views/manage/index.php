<?php

$this->title = 'لیست فایلهای اکسل';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'کارتریج', 'url' => ['/process/ird/cartridge/payesh/excelmanager/manage/index']],
    'لیست فایل اکسل',
    $this->title
];

?>

<?= $this->render('@nad/common/modules/excelmanager/views/manage/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
