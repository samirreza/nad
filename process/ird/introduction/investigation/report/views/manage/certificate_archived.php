<?php

$this->title = 'شناسنامه ' . $report->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'آشنایی', 'url' => ['/introduction/manage/index']],
    ['label' => 'بررسی فرایندی', 'url' => ['/introduction/manage/investigation']],
    'داده گاه گزارش',
    ['label' => 'لیست داده گاه گزارش', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه گزارش',
        'url' => ['/introduction/investigation/report/manage/index']
    ],
    [
        'label' => 'داده گاه گزارش',
        'url' => ['/introduction/investigation/report/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند گزارش',
        'url' => ['/introduction/investigation/report/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/introduction/investigation/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/report/views/report/certificate_archived', [
   'source' => $source,
   'proposal' => $proposal,
   'report' => $report,
    'moduleId' => 'introduction',
    'baseRoute' => '/introduction/investigation'
]);
