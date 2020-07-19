<?php

$this->title = 'برنامه انتقال داده';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'ته نشینی', 'url' => ['/process/ird/sedimentation']],
    ['label' => 'پایش', 'url' => ['/process/ird/sedimentation/manage/payesh']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/excelmanager/views/manage/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
