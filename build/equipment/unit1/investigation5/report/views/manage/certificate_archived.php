<?php

$this->title = 'شناسنامه ' . $report->title;
$this->params['breadcrumbs'] = [
    'احداث',
    'تجهیزات',
    ['label' => 'واحد 1', 'url' => ['/build/equipment/unit1/manage/index']],
    ['label' => 'فعالیت ه', 'url' => ['/build/equipment/unit1/manage/investigation5']],
    'داده گاه گزارش',
    ['label' => 'لیست داده گاه گزارش', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه گزارش',
        'url' => ['/build/equipment/unit1/investigation5/report/manage/index']
    ],
    [
        'label' => 'داده گاه گزارش',
        'url' => ['/build/equipment/unit1/investigation5/report/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند گزارش',
        'url' => ['/build/equipment/unit1/investigation5/report/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/build/equipment/unit1/investigation5/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/report/views/report/certificate_archived', [
   'source' => $source,
   'proposal' => $proposal,
   'report' => $report,
    'moduleId' => 'unit1',
    'baseRoute' => '/unit1/investigation5'
]);