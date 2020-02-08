<?php

$this->title = 'لیست تجهیزات';
// $this->params['stageCategoriesIndex'] = ['/engineering/instrument/stage/category/index'];
$this->params['breadcrumbs'] = [
    'فنی',
    'ابزار دقیق',
    ['label' => 'تجهیزات', 'url' => ['/engineering/instrument/device/device/manage/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/device/views/device-part/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'deviceModel' => $deviceModel
]);
