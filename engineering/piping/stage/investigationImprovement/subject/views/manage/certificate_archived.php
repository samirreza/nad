<?php

$this->title = 'شناسنامه ' . $subject->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'مراحل', 'url' => ['/engineering/piping/stage/manage/index']],
    ['label' => 'روش  و دستورالعمل', 'url' => ['/engineering/piping/stage/manage/investigation-improvement']],
    'داده گاه موضوع',
    ['label' => 'لیست داده گاه موضوع', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه موضوع',
        'url' => ['/engineering/piping/stage/investigationImprovement/subject/manage/index']
    ],
    [
        'label' => 'داده گاه موضوع',
        'url' => ['/engineering/piping/stage/investigationImprovement/subject/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند موضوع',
        'url' => ['/engineering/piping/stage/investigationImprovement/subject/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/engineering/piping/stage/investigationImprovement/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/subject/views/subject/certificate_archived', [
   'subject' => $subject,
    'moduleId' => 'stage',
    'baseRoute' => '/engineering/piping/stage/investigationImprovement'
]);
