<?php

$this->title = 'لیست مراحل کنترل';
$this->params['breadcrumbs'] = [
    'فنی',
    'کنترل',
    $this->title
];

?>

<?= $this->render('@nad/common/modules/engineering/stage/views/manage/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
