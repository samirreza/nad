<?php

$this->title = 'لیست مکانها';
$this->params['breadcrumbs'] = [
    'فنی',
    ['label' => 'لیست مکانها', 'url' => ['/engineering/instrument/location/category/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/engineering/location/views/category/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
