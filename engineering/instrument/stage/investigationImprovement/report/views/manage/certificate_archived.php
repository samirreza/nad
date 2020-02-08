<?php

$this->title = 'شناسنامه ' . $report->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'ابزار دقیق',
    ['label' => 'مراحل', 'url' => ['/engineering/instrument/stage/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/instrument/stage/manage/investigation-improvement']],
    'داده گاه گزارش',
    ['label' => 'لیست داده گاه گزارش', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه گزارش',
        'url' => ['/engineering/instrument/stage/investigationImprovement/report/manage/index']
    ],
    [
        'label' => 'داده گاه گزارش',
        'url' => ['/engineering/instrument/stage/investigationImprovement/report/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند گزارش',
        'url' => ['/engineering/instrument/stage/investigationImprovement/report/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/engineering/instrument/stage/investigationImprovement/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/report/views/report/certificate_archived', [
   'source' => $source,
   'proposal' => $proposal,
   'report' => $report,
    'moduleId' => 'stage',
    'baseRoute' => '/stage/investigationImprovement'
]);
