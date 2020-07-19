<?php

$this->title = 'برنامه انتقال داده';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'آر او', 'url' => ['/process/ird/ro']],
    ['label' => 'پایش', 'url' => ['/process/ird/ro/manage/payesh']],
    $this->title
];


?>

<?= $this->render('@nad/common/modules/excelmanager/views/manage/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
