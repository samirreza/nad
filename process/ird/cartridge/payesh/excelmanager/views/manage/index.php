<?php

$this->title = 'برنامه انتقال داده';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'کارتریج', 'url' => ['/process/ird/cartridge']],
    ['label' => 'پایش', 'url' => ['/process/ird/cartridge/manage/payesh']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/excelmanager/views/manage/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
