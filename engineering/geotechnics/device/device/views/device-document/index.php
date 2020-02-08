<?php

$this->title = 'لیست مدارک';
$this->params['deviceIndex'] = ['/engineering/geotechnics/device/device/manage/index'];
$this->params['breadcrumbs'] = [
    'فنی',
    'ژئوتکنیک',
    ['label' => 'تجهیزات', 'url' => ['/engineering/geotechnics/device/device/manage/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/device/views/device-document/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
]);
