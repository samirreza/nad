<?php

$this->title = 'لیست نام مدارک';
$this->params['breadcrumbs'] = [
    'فنی',
    'ژئوتکنیک',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/geotechnics/device/manage/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/device/views/doc-name-lookup/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
