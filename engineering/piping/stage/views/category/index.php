<?php

$this->title = 'لیست رده بندی مراحل و بسته مدارک';
$this->params['breadcrumbs'] = [
    'فنی',   
    'لوله کشی',    
    ['label' => 'لیست مراحل', 'url' => ['/engineering/piping/stage/manage/index']],    
    $this->title
];
$this->params['stageIndexBtnLabel'] = 'لیست مراحل لوله کشی';
?>

<?= $this->render('@nad/common/modules/engineering/stage/views/category/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
