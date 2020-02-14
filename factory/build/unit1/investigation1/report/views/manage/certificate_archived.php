<?php

$this->title = 'شناسنامه ' . $report->title;
$this->params['breadcrumbs'] = [
    'کارخانه',
    'احداث',
    ['label' => 'واحد 1', 'url' => ['/factory/build/unit1/manage/index']],
    ['label' => 'فعالیت الف', 'url' => ['/factory/build/unit1/manage/investigation1']],
    'داده گاه گزارش',
    ['label' => 'لیست داده گاه گزارش', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه گزارش',
        'url' => ['/factory/build/unit1/investigation1/report/manage/index']
    ],
    [
        'label' => 'داده گاه گزارش',
        'url' => ['/factory/build/unit1/investigation1/report/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند گزارش',
        'url' => ['/factory/build/unit1/investigation1/report/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/factory/build/unit1/investigation1/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/report/views/report/certificate_archived', [
   'source' => $source,
   'proposal' => $proposal,
   'report' => $report,
    'moduleId' => 'unit1',
    'baseRoute' => '/unit1/investigation1'
]);
