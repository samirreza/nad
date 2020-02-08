<?php

$this->title = 'لیست مدارک';
$this->params['deviceIndex'] = ['/engineering/construction/device/device/manage/index'];
$this->params['breadcrumbs'] = [
    'فنی',
    'ساختمان',
    ['label' => 'تجهیزات', 'url' => ['/engineering/construction/device/device/manage/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/device/views/device-instance-document/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'instanceModel' => $instanceModel
]);
