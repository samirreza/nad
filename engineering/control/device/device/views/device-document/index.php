<?php

$this->title = 'لیست مدارک';
$this->params['deviceIndex'] = ['/engineering/control/device/device/manage/index'];
$this->params['breadcrumbs'] = [
    'فنی',
    'کنترل',
    ['label' => 'تجهیزات', 'url' => ['/engineering/control/device/device/manage/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/device/views/device-document/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
]);
