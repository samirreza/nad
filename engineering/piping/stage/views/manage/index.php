<?php

$this->title = 'لیست مراحل لوله کشی';
$this->params['breadcrumbs'] = [
    'فنی',
    ['label' => 'لوله کشی', 'url' => ['/engineering/piping']],    
    $this->title
];

?>

<?= $this->render('@nad/common/modules/engineering/stage/views/manage/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
