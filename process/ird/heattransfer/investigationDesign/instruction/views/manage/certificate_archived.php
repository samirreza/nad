<?php

$this->title = 'شناسنامه ' . $instruction->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'انتقال حرارت', 'url' => ['/process/ird/heattransfer/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/process/ird/heattransfer/manage/investigation-design']],
    'داده گاه دستورالعمل',
    ['label' => 'لیست داده گاه دستورالعمل', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه دستورالعمل',
        'url' => ['/process/ird/heattransfer/investigationDesign/instruction/manage/index']
    ],
    [
        'label' => 'داده گاه دستورالعمل',
        'url' => ['/process/ird/heattransfer/investigationDesign/instruction/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند دستورالعمل',
        'url' => ['/process/ird/heattransfer/investigationDesign/instruction/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/process/ird/heattransfer/investigationDesign/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/instruction/views/instruction/certificate_archived', [
   'source' => $source,
   'proposal' => $proposal,
   'report' => $report,
   'method' => $method,
   'instruction' => $instruction,
    'moduleId' => 'heattransfer',
    'baseRoute' => '/process/ird/heattransfer/investigationDesign'
]);
