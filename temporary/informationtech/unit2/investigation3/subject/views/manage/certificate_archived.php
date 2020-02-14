<?php

$this->title = 'شناسنامه ' . $subject->title;
$this->params['breadcrumbs'] = [
    'موقت',
    'آی تی',
    ['label' => 'واحد 2', 'url' => ['/temporary/informationtech/unit2/manage/index']],
    ['label' => 'فعالیت ج', 'url' => ['/temporary/informationtech/unit2/manage/investigation3']],
    'داده گاه موضوع',
    ['label' => 'لیست داده گاه موضوع', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه موضوع',
        'url' => ['/temporary/informationtech/unit2/investigation3/subject/manage/index']
    ],
    [
        'label' => 'داده گاه موضوع',
        'url' => ['/temporary/informationtech/unit2/investigation3/subject/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند موضوع',
        'url' => ['/temporary/informationtech/unit2/investigation3/subject/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/temporary/informationtech/unit2/investigation3/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/subject/views/subject/certificate_archived', [
   'subject' => $subject,
    'moduleId' => 'unit2',
    'baseRoute' => '/temporary/informationtech/unit2/investigation3'
]);
