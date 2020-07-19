<?php

$this->title = 'برنامه انتقال داده';
$this->params['breadcrumbs'] = [
    'مدیریت',
    'هماهنگی',
    ['label' => 'پایش', 'url' => ['/coordination/manage/payesh']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/excelmanager/views/manage/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
