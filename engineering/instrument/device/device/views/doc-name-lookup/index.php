<?php

$this->title = 'لیست نام مدارک';
$this->params['breadcrumbs'] = [
    'فنی',
    'ابزار دقیق',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/instrument/device/manage/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/device/views/doc-name-lookup/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
