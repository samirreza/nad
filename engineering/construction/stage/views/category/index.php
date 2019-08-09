<?php

$this->title = 'لیست مکانها';
$this->params['breadcrumbs'] = [
    'فنی',    
    ['label' => 'لیست مراحل', 'url' => ['/engineering/construction/stage/category/index']],    
    $this->title
];

?>

<?= $this->render('@nad/common/modules/engineering/stage/views/category/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
