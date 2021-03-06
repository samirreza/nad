<?php

$this->title = 'لیست گروه های مدارک';
$this->params['deviceIndex'] = ['/engineering/electricity/device/device/manage/index'];
$this->params['breadcrumbs'] = [
    'فنی',
    'برق',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/electricity/device/manage/index']],
    ['label' => 'لیست تجهیزات', 'url' => ['/engineering/electricity/device/device/manage/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/device/views/document-group/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'deviceModel' => $deviceModel
]);
