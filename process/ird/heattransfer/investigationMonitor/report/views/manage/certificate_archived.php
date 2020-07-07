<?php

$this->title = 'شناسنامه ' . $report->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'انتقال حرارت', 'url' => ['/process/ird/heattransfer/manage/index']],
    ['label' => 'بررسی پایش', 'url' => ['/process/ird/heattransfer/manage/investigation-monitor']],
    'داده گاه گزارش',
    ['label' => 'لیست داده گاه گزارش', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه گزارش',
        'url' => ['/process/ird/heattransfer/investigationMonitor/report/manage/index']
    ],
    [
        'label' => 'داده گاه گزارش',
        'url' => ['/process/ird/heattransfer/investigationMonitor/report/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند گزارش',
        'url' => ['/process/ird/heattransfer/investigationMonitor/report/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/process/ird/heattransfer/investigationMonitor/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/report/views/report/certificate_archived', [
   'source' => $source,
   'proposal' => $proposal,
   'report' => $report,
    'moduleId' => 'heattransfer',
    'baseRoute' => '/process/ird/heattransfer/investigationMonitor-monitor'
]);
