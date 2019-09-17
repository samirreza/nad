<?php

$this->title = 'مراحل';
$this->params['breadcrumbs'] = [
    'فنی',   
    'لوله کشی',    
    ['label' => 'مراحل', 'url' => ['/engineering/piping/stage/manage/start']],     
    $this->title
];
?>

<?= $this->render('@nad/common/modules/engineering/stage/views/category/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
