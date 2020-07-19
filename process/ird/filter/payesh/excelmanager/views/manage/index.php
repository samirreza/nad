<?php

$this->title = 'برنامه انتقال داده';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'فیلترشنی', 'url' => ['/process/ird/filter']],
    ['label' => 'پایش', 'url' => ['/process/ird/filter/manage/payesh']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/excelmanager/views/manage/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
