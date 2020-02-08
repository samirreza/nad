<?php

$this->title = 'لیست گروه های مدارک';
$this->params['deviceIndex'] = ['/engineering/mechanics/device/device/manage/index'];
$this->params['breadcrumbs'] = [
    'فنی',
    'مکانیک',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/mechanics/device/manage/index']],
    ['label' => 'لیست تجهیزات', 'url' => ['/engineering/mechanics/device/device/manage/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/device/views/document-group/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'deviceModel' => $deviceModel
]);
