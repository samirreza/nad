<?php

$this->title = 'لیست نام مدارک';
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/piping/device/manage/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/device/views/doc-name-lookup/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
