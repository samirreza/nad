<?php

$this->title = 'شناسنامه ' . $report->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'ساختمان',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/construction/device/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/engineering/construction/device/manage/investigation-design']],
    ['label' => 'لیست گزارش', 'url' => ['index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/report/views/report/certificate', [
    'source' => $source,
    'proposal' => $proposal,
    'report' => $report,
    'moduleId' => 'device',
    'baseRoute' => '/device/investigationDesign-monitor'
]);
