<?php

$this->title = 'شناسنامه ' . $report->title;
$this->params['breadcrumbs'] = [
    'کارخانه',
    'تولید',
    ['label' => 'تعمیرات و نگهداری', 'url' => ['/factory/production/unit4/manage/index']],
    ['label' => 'فعالیت د', 'url' => ['/factory/production/unit4/manage/investigation4']],
    'داده گاه گزارش',
    ['label' => 'لیست داده گاه گزارش', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه گزارش',
        'url' => ['/factory/production/unit4/investigation4/report/manage/index']
    ],
    [
        'label' => 'داده گاه گزارش',
        'url' => ['/factory/production/unit4/investigation4/report/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند گزارش',
        'url' => ['/factory/production/unit4/investigation4/report/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/factory/production/unit4/investigation4/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/report/views/report/certificate_archived', [
   'source' => $source,
   'proposal' => $proposal,
   'report' => $report,
    'moduleId' => 'unit4',
    'baseRoute' => '/unit4/investigation4'
]);