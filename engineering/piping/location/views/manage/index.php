<?php

$this->title = 'لیست مدارک لوله کشی';
$this->params['breadcrumbs'] = [
    'فنی',    
    // ['label' => 'لیست مکانها', 'url' => ['/piping/location/manage/index']],    
    $this->title
];

?>

<?= $this->render('@nad/common/modules/engineering/location/views/manage/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
