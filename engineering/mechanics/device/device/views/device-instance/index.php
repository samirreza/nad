<?php

$this->title = 'لیست تجهیزات';
// $this->params['stageCategoriesIndex'] = ['/engineering/mechanics/stage/category/index'];
$this->params['breadcrumbs'] = [
    'فنی',
    'مکانیک',
    ['label' => 'تجهیزات', 'url' => ['/engineering/mechanics/device/device/manage/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/device/views/device-instance/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'deviceModel' => $deviceModel
]);
