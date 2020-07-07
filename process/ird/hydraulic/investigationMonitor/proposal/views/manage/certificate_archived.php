<?php

$this->title = 'شناسنامه ' . $proposal->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'هیدرولیک', 'url' => ['/process/ird/hydraulic/manage/index']],
    ['label' => 'بررسی پایش', 'url' => ['/process/ird/hydraulic/manage/investigation-monitor']],
    'داده گاه پروپوزال',
    ['label' => 'لیست داده گاه پروپوزال', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه پروپوزال',
        'url' => ['/process/ird/hydraulic/investigationMonitor/proposal/manage/index']
    ],
    [
        'label' => 'داده گاه پروپوزال',
        'url' => ['/process/ird/hydraulic/investigationMonitor/proposal/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند پروپوزال',
        'url' => ['/process/ird/hydraulic/investigationMonitor/proposal/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/process/ird/hydraulic/investigationMonitor/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/certificate_archived', [
   'source' => $source,
   'proposal' => $proposal,
   'report' => $report,
    'moduleId' => 'hydraulic',
    'baseRoute' => '/process/ird/hydraulic/investigationMonitor-monitor'
]);
