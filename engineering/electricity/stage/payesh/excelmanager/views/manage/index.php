<?php

$this->title = 'لیست فایلهای اکسل';
$this->params['breadcrumbs'] = [
    'موقت',
    'تامین',
    ['label' => 'واحد 1', 'url' => ['/engineering/electricity/stage/payesh/excelmanager/manage/index']],
    'لیست فایل اکسل',
    $this->title
];

?>

<?= $this->render('@nad/common/modules/excelmanager/views/manage/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
