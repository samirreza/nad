<?php

$this->title = 'شناسنامه ' . $report->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'آر او', 'url' => ['/ro/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/ro/manage/investigation-design']],
    'داده گاه گزارش',
    ['label' => 'لیست داده گاه گزارش', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه گزارش',
        'url' => ['/ro/investigationDesign/report/manage/index']
    ],
    [
        'label' => 'داده گاه گزارش',
        'url' => ['/ro/investigationDesign/report/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند گزارش',
        'url' => ['/ro/investigationDesign/report/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/ro/investigationDesign/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/report/views/report/certificate_archived', [
   'source' => $source,
   'proposal' => $proposal,
   'report' => $report,
    'moduleId' => 'ro',
    'baseRoute' => '/ro/investigation-design'
]);
