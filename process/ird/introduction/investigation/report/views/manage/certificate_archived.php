<?php

$this->title = 'شناسنامه ' . $report->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'آشنایی', 'url' => ['/process/ird/introduction/manage/index']],
    ['label' => 'بررسی فرایندی', 'url' => ['/process/ird/introduction/manage/investigation']],
    'داده گاه گزارش',
    ['label' => 'لیست داده گاه گزارش', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه گزارش',
        'url' => ['/process/ird/introduction/investigation/report/manage/index']
    ],
    [
        'label' => 'داده گاه گزارش',
        'url' => ['/process/ird/introduction/investigation/report/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند گزارش',
        'url' => ['/process/ird/introduction/investigation/report/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/process/ird/introduction/investigation/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/report/views/report/certificate_archived', [
   'source' => $source,
   'proposal' => $proposal,
   'report' => $report,
    'moduleId' => 'introduction',
    'baseRoute' => '/process/ird/introduction/investigation'
]);
