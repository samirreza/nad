<?php

$this->title = 'شناسنامه ' . $subject->title;
$this->params['breadcrumbs'] = [
    'بندر',
    'واحد بندر',
    ['label' => 'واحد 3', 'url' => ['/seaport/wayside/unit3/manage/index']],
    ['label' => 'فعالیت ه', 'url' => ['/seaport/wayside/unit3/manage/investigation5']],
    'داده گاه موضوع',
    ['label' => 'لیست داده گاه موضوع', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه موضوع',
        'url' => ['/seaport/wayside/unit3/investigation5/subject/manage/index']
    ],
    [
        'label' => 'داده گاه موضوع',
        'url' => ['/seaport/wayside/unit3/investigation5/subject/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند موضوع',
        'url' => ['/seaport/wayside/unit3/investigation5/subject/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/seaport/wayside/unit3/investigation5/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/subject/views/subject/certificate_archived', [
   'subject' => $subject,
    'moduleId' => 'unit3',
    'baseRoute' => '/seaport/wayside/unit3/investigation5'
]);
