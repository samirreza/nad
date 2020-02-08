<?php

$this->title = 'شناسنامه ' . $subject->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'ساختمان',
    ['label' => 'مراحل', 'url' => ['/engineering/construction/stage/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/construction/stage/manage/investigation-improvement']],
    'داده گاه موضوع',
    ['label' => 'لیست داده گاه موضوع', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه موضوع',
        'url' => ['/engineering/construction/stage/investigationImprovement/subject/manage/index']
    ],
    [
        'label' => 'داده گاه موضوع',
        'url' => ['/engineering/construction/stage/investigationImprovement/subject/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند موضوع',
        'url' => ['/engineering/construction/stage/investigationImprovement/subject/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/engineering/construction/stage/investigationImprovement/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/subject/views/subject/certificate_archived', [
   'subject' => $subject,
    'moduleId' => 'stage',
    'baseRoute' => '/engineering/construction/stage/investigationImprovement'
]);
