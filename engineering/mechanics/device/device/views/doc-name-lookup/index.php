<?php

$this->title = 'لیست نام مدارک';
$this->params['breadcrumbs'] = [
    'فنی',
    'مکانیک',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/mechanics/device/manage/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/device/views/doc-name-lookup/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
