<?php

$this->title = 'شناسنامه ' . $instruction->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'آزمایشگاه',
    ['label' => 'واحد 3', 'url' => ['/process/laboratory/unit3/manage/index']],
    ['label' => 'فعالیت بررسی', 'url' => ['/process/laboratory/unit3/manage/investigation1']],
    'داده گاه دستورالعمل',
    ['label' => 'لیست داده گاه دستورالعمل', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه دستورالعمل',
        'url' => ['/process/laboratory/unit3/investigation1/instruction/manage/index']
    ],
    [
        'label' => 'داده گاه دستورالعمل',
        'url' => ['/process/laboratory/unit3/investigation1/instruction/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند دستورالعمل',
        'url' => ['/process/laboratory/unit3/investigation1/instruction/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/process/laboratory/unit3/investigation1/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/instruction/views/instruction/certificate_archived', [
   'source' => $source,
   'proposal' => $proposal,
   'report' => $report,
   'method' => $method,
   'instruction' => $instruction,
    'moduleId' => 'unit3',
    'baseRoute' => '/process/laboratory/unit3/investigation1'
]);
