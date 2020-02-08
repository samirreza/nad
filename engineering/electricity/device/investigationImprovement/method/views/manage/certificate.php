<?php

$this->title = 'شناسنامه ' . $method->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'برق',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/electricity/device/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/electricity/device/manage/investigation-improvement']],
    ['label' => 'لیست روش', 'url' => ['index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/method/views/method/certificate', [
    'source' => $source,
    'proposal' => $proposal,
    'report' => $report,
    'method' => $method,
    'moduleId' => 'device',
    'baseRoute' => '/device/investigationImprovement'
]);
