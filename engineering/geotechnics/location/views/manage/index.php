<?php

$this->title = 'لیست گروه های مدارک';
$this->params['stageCategoriesIndex'] = ['/engineering/geotechnics/stage/category/index'];
$this->params['breadcrumbs'] = [
    'فنی',
    'ژئوتکنیک',
    ['label' => 'مراحل', 'url' => ['/engineering/geotechnics/stage/manage/start']],
    ['label' => 'لیست مراحل', 'url' => ['/engineering/geotechnics/stage/category']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/engineering/location/views/manage/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'categoryModel' => $categoryModel
]);
