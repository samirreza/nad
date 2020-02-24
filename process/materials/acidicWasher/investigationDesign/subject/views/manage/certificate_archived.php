<?php

$this->title = 'شناسنامه ' . $subject->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'مواد',
    ['label' => 'شوینده اسیدی', 'url' => ['/acidicWasher/manage/index']],
    ['label' => 'مطالعات کلی و دستورالعمل ها', 'url' => ['/acidicWasher/manage/investigationDesign']],
    'داده گاه موضوع',
    ['label' => 'لیست داده گاه موضوع', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه موضوع',
        'url' => ['/acidicWasher/investigationDesign/subject/manage/index']
    ],
    [
        'label' => 'داده گاه موضوع',
        'url' => ['/acidicWasher/investigationDesign/subject/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند موضوع',
        'url' => ['/acidicWasher/investigationDesign/subject/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/acidicWasher/investigationDesign/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/subject/views/subject/certificate_archived', [
   'subject' => $subject,
    'moduleId' => 'acidicWasher',
    'baseRoute' => '/acidicWasher/investigationDesign'
]);
