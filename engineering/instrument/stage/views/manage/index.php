<?php

$this->title = 'لیست مراحل ابزار دقیق';
$this->params['breadcrumbs'] = [
    'فنی',
    'ابزار دقیق',
    $this->title
];

?>

<?= $this->render('@nad/common/modules/engineering/stage/views/manage/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
