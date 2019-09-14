<?php

$this->title = 'لیست مراحل مکانیک';
$this->params['breadcrumbs'] = [
    'فنی',
    'مکانیک',
    $this->title
];

?>

<?= $this->render('@nad/common/modules/engineering/stage/views/manage/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
