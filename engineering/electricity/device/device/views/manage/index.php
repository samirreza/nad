<?php

$this->title = 'لیست تجهیزات';
// $this->params['stageCategoriesIndex'] = ['/engineering/electricity/stage/category/index'];
$this->params['breadcrumbs'] = [
    'فنی',
    'برق',
    ['label' => 'تجهیزات', 'url' => ['/engineering/electricity/device/device/manage/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/device/views/manage/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
]);
