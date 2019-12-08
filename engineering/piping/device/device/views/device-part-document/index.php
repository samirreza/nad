<?php

$this->title = 'لیست مدارک';
$this->params['deviceIndex'] = ['/engineering/piping/device/device/manage/index'];
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'تجهیزات', 'url' => ['/engineering/piping/device/device/manage/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/device/views/device-part-document/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'partModel' => $partModel
]);
