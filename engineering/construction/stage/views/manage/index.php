<?php

$this->title = 'لیست مراحل ساختمان';
$this->params['breadcrumbs'] = [
    'فنی',
    'ساختمان',
    $this->title
];

?>

<?= $this->render('@nad/common/modules/engineering/stage/views/manage/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
