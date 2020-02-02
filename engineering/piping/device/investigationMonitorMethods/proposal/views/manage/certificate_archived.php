<?php

$this->title = 'شناسنامه ' . $proposal->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/piping/device/manage/index']],
    ['label' => 'بررسی روشهای پایش', 'url' => ['/engineering/piping/device/manage/investigation-monitor-methods']],
    'داده گاه پروپوزال',
    ['label' => 'لیست داده گاه پروپوزال', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه پروپوزال',
        'url' => ['/engineering/piping/device/investigationMonitorMethods/proposal/manage/index']
    ],
    [
        'label' => 'داده گاه پروپوزال',
        'url' => ['/engineering/piping/device/investigationMonitorMethods/proposal/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند پروپوزال',
        'url' => ['/engineering/piping/device/investigationMonitorMethods/proposal/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/engineering/piping/device/investigationMonitorMethods/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/certificate_archived', [
   'source' => $source,
   'proposal' => $proposal,
   'report' => $report,
    'moduleId' => 'device',
    'baseRoute' => '/device/investigationMonitorMethods'
]);
