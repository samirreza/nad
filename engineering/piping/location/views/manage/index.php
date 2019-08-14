<?php

$this->title = 'لیست گروه های مدارک';
$this->params['stageCategoriesIndex'] = ['/engineering/piping/stage/category/index'];
$this->params['breadcrumbs'] = [
    'فنی',       
    ['label' => 'لوله کشی', 'url' => ['/engineering/piping']],    
    ['label' => 'لیست رده بندی مراحل و بسته مدارک', 'url' => ['/engineering/piping/stage/category']],    
    $this->title
];

?>

<?= $this->render('@nad/common/modules/engineering/location/views/manage/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
