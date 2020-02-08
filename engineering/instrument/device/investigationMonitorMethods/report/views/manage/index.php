<?php

$this->title = 'لیست گزارش';
$this->params['breadcrumbs'] = [
    'فنی',
    'ابزار دقیق',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/instrument/device/manage/index']],
    ['label' => 'بررسی روشهای پایش', 'url' => ['/engineering/instrument/device/manage/investigation-monitor-methods']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/report/views/report/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
