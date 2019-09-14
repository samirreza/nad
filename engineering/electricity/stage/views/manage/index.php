<?php

$this->title = 'لیست مراحل برق';
$this->params['breadcrumbs'] = [
    'فنی',
    'برق',
    $this->title
];

?>

<?= $this->render('@nad/common/modules/engineering/stage/views/manage/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
