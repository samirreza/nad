<?php

$this->title = 'شناسنامه ' . $instruction->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'منعقدکننده', 'url' => ['/coagulant/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/coagulant/manage/investigation-design']],
    'داده گاه دستورالعمل',
    ['label' => 'لیست داده گاه دستورالعمل', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه دستورالعمل',
        'url' => ['/coagulant/investigationDesign/instruction/manage/index']
    ],
    [
        'label' => 'داده گاه دستورالعمل',
        'url' => ['/coagulant/investigationDesign/instruction/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند دستورالعمل',
        'url' => ['/coagulant/investigationDesign/instruction/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/coagulant/investigationDesign/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/instruction/views/instruction/certificate_archived', [
   'source' => $source,
   'proposal' => $proposal,
   'report' => $report,
   'method' => $method,
   'instruction' => $instruction,
    'moduleId' => 'coagulant',
    'baseRoute' => '/coagulant/investigationDesign-monitor'
]);
