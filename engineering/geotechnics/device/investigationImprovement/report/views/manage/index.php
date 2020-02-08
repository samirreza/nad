<?php

$this->title = 'لیست گزارش';
$this->params['breadcrumbs'] = [
    'فنی',
    'ژئوتکنیک',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/geotechnics/device/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/geotechnics/device/manage/investigation-improvement']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/report/views/report/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
