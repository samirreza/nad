<?php

$this->title = 'لیست مدارک';
$this->params['deviceIndex'] = ['/engineering/mechanics/device/device/manage/index'];
$this->params['breadcrumbs'] = [
    'فنی',
    'مکانیک',
    ['label' => 'تجهیزات', 'url' => ['/engineering/mechanics/device/device/manage/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/device/views/device-part-instance-document/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'instanceModel' => $instanceModel
]);
