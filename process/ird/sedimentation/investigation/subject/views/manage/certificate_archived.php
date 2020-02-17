<?php

$this->title = 'شناسنامه ' . $subject->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'ته نشینی', 'url' => ['/sedimentation/manage/index']],
    ['label' => 'سایرگزارشها', 'url' => ['/sedimentation/manage/investigation']],
    'داده گاه موضوع',
    ['label' => 'لیست داده گاه موضوع', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه موضوع',
        'url' => ['/sedimentation/investigation/subject/manage/index']
    ],
    [
        'label' => 'داده گاه موضوع',
        'url' => ['/sedimentation/investigation/subject/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند موضوع',
        'url' => ['/sedimentation/investigation/subject/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/sedimentation/investigation/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/subject/views/subject/certificate_archived', [
   'subject' => $subject,
    'moduleId' => 'sedimentation',
    'baseRoute' => '/sedimentation/investigation'
]);
