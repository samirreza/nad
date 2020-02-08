<?php

$this->title = 'لیست تجهیزات';
// $this->params['stageCategoriesIndex'] = ['/engineering/geotechnics/stage/category/index'];
$this->params['breadcrumbs'] = [
    'فنی',
    'ژئوتکنیک',
    ['label' => 'تجهیزات', 'url' => ['/engineering/geotechnics/device/device/manage/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/device/views/manage/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
]);
