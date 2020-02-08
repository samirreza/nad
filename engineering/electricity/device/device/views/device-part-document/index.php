<?php

$this->title = 'لیست مدارک';
$this->params['deviceIndex'] = ['/engineering/electricity/device/device/manage/index'];
$this->params['breadcrumbs'] = [
    'فنی',
    'برق',
    ['label' => 'تجهیزات', 'url' => ['/engineering/electricity/device/device/manage/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/device/views/device-part-document/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'partModel' => $partModel
]);
