<?php

$this->title = 'لیست گروه های مدارک';
$this->params['stageCategoriesIndex'] = ['/engineering/piping/stage/category/index'];
$this->params['breadcrumbs'] = [
    'فنی',       
    'لوله کشی',
    ['label' => 'مراحل', 'url' => ['/engineering/piping/stage/manage/start']], 
    ['label' => 'لیست مراحل', 'url' => ['/engineering/piping/stage/category']],    
    $this->title
];

?>

<?= $this->render('@nad/common/modules/engineering/location/views/manage/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'categoryModel' => $categoryModel
]);
