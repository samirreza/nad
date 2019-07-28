<?php

$this->title = 'لیست مراحل چاه';
$this->params['breadcrumbs'] = [
    'فنی',
    'چاه',
    $this->title
];

?>

<?= $this->render('@nad/common/modules/engineering/stage/views/manage/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
