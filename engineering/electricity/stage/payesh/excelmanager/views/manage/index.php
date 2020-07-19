<?php

$this->title = 'برنامه انتقال داده';
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'مراحل', 'url' => ['/engineering/electricity/stage']],
    ['label' => 'پایش', 'url' => ['/engineering/electricity/stage/manage/payesh']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/excelmanager/views/manage/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
