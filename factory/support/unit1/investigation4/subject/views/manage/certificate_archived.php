<?php

$this->title = 'شناسنامه ' . $subject->title;
$this->params['breadcrumbs'] = [
    'کارخانه',
    'پشتیبانی',
    ['label' => 'واحد 1', 'url' => ['/factory/support/unit1/manage/index']],
    ['label' => 'فعالیت د', 'url' => ['/factory/support/unit1/manage/investigation4']],
    'داده گاه موضوع',
    ['label' => 'لیست داده گاه موضوع', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه موضوع',
        'url' => ['/factory/support/unit1/investigation4/subject/manage/index']
    ],
    [
        'label' => 'داده گاه موضوع',
        'url' => ['/factory/support/unit1/investigation4/subject/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند موضوع',
        'url' => ['/factory/support/unit1/investigation4/subject/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/factory/support/unit1/investigation4/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/subject/views/subject/certificate_archived', [
   'subject' => $subject,
    'moduleId' => 'unit1',
    'baseRoute' => '/factory/support/unit1/investigation4'
]);
