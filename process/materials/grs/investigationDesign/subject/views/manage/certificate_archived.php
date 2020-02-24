<?php

$this->title = 'شناسنامه ' . $subject->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'مواد',
    ['label' => 'جی آر اس', 'url' => ['/grs/manage/index']],
    ['label' => 'مطالعات کلی و دستورالعمل ها', 'url' => ['/grs/manage/investigation-design']],
    'داده گاه موضوع',
    ['label' => 'لیست داده گاه موضوع', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه موضوع',
        'url' => ['/grs/investigationDesign/subject/manage/index']
    ],
    [
        'label' => 'داده گاه موضوع',
        'url' => ['/grs/investigationDesign/subject/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند موضوع',
        'url' => ['/grs/investigationDesign/subject/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/grs/investigationDesign/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/subject/views/subject/certificate_archived', [
   'subject' => $subject,
    'moduleId' => 'grs',
    'baseRoute' => '/grs/investigationDesign'
]);
