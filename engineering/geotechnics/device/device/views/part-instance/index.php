<?php

$this->title = 'لیست قطعات';
// $this->params['stageCategoriesIndex'] = ['/engineering/geotechnics/stage/category/index'];
$this->params['breadcrumbs'] = [
    'فنی',
    'ژئوتکنیک',
    ['label' => 'تجهیزات', 'url' => ['/engineering/geotechnics/device/device/manage/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/device/views/part-instance/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'partModel' => $partModel
]);
