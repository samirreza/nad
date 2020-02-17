<?php

$this->title = 'شناسنامه ' . $subject->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'هیدرولیک', 'url' => ['/hydraulic/manage/index']],
    ['label' => 'سایرگزارشها', 'url' => ['/hydraulic/manage/investigation']],
    'داده گاه موضوع',
    ['label' => 'لیست داده گاه موضوع', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه موضوع',
        'url' => ['/hydraulic/investigation/subject/manage/index']
    ],
    [
        'label' => 'داده گاه موضوع',
        'url' => ['/hydraulic/investigation/subject/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند موضوع',
        'url' => ['/hydraulic/investigation/subject/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/hydraulic/investigation/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/subject/views/subject/certificate_archived', [
   'subject' => $subject,
    'moduleId' => 'hydraulic',
    'baseRoute' => '/hydraulic/investigation'
]);
