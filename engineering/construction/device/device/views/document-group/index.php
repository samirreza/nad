<?php

$this->title = 'لیست گروه های مدارک';
$this->params['deviceIndex'] = ['/engineering/construction/device/device/manage/index'];
$this->params['breadcrumbs'] = [
    'فنی',
    'ساختمان',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/construction/device/manage/index']],
    ['label' => 'لیست تجهیزات', 'url' => ['/engineering/construction/device/device/manage/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/device/views/document-group/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'deviceModel' => $deviceModel
]);
