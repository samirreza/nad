<?php

$this->title = 'لیست گروه های مدارک';
$this->params['deviceIndex'] = ['/engineering/geotechnics/device/device/manage/index'];
$this->params['breadcrumbs'] = [
    'فنی',
    'ژئوتکنیک',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/geotechnics/device/manage/index']],
    ['label' => 'لیست تجهیزات', 'url' => ['/engineering/geotechnics/device/device/manage/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/device/views/document-group/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'deviceModel' => $deviceModel
]);
