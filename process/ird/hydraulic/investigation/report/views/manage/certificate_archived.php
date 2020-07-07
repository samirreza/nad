<?php

$this->title = 'شناسنامه ' . $report->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'هیدرولیک', 'url' => ['/process/ird/hydraulic/manage/index']],
    ['label' => 'بررسی فرایندی', 'url' => ['/process/ird/hydraulic/manage/investigation']],
    'داده گاه گزارش',
    ['label' => 'لیست داده گاه گزارش', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه گزارش',
        'url' => ['/process/ird/hydraulic/investigation/report/manage/index']
    ],
    [
        'label' => 'داده گاه گزارش',
        'url' => ['/process/ird/hydraulic/investigation/report/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند گزارش',
        'url' => ['/process/ird/hydraulic/investigation/report/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/process/ird/hydraulic/investigation/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/report/views/report/certificate_archived', [
   'source' => $source,
   'proposal' => $proposal,
   'report' => $report,
    'moduleId' => 'hydraulic',
    'baseRoute' => '/process/ird/hydraulic/investigation'
]);
