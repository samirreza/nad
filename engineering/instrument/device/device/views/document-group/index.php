<?php

$this->title = 'لیست گروه های مدارک';
$this->params['deviceIndex'] = ['/engineering/instrument/device/device/manage/index'];
$this->params['breadcrumbs'] = [
    'فنی',
    'ابزار دقیق',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/instrument/device/manage/index']],
    ['label' => 'لیست تجهیزات', 'url' => ['/engineering/instrument/device/device/manage/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/device/views/document-group/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'deviceModel' => $deviceModel
]);
