<?php

$this->title = 'لیست مدارک';
$this->params['deviceIndex'] = ['/engineering/instrument/device/device/manage/index'];
$this->params['breadcrumbs'] = [
    'فنی',
    'ابزار دقیق',
    ['label' => 'تجهیزات', 'url' => ['/engineering/instrument/device/device/manage/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/device/views/device-part-document/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'partModel' => $partModel
]);
