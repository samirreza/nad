<?php

$this->title = 'شناسنامه ' . $proposal->title;
$this->params['breadcrumbs'] = [
    'موقت',
    'اداری',
    ['label' => 'واحد 2', 'url' => ['/temporary/administrative/unit2/manage/index']],
    ['label' => 'فعالیت ه', 'url' => ['/temporary/administrative/unit2/manage/investigation5']],
    'داده گاه پروپوزال',
    ['label' => 'لیست داده گاه پروپوزال', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه پروپوزال',
        'url' => ['/temporary/administrative/unit2/investigation5/proposal/manage/index']
    ],
    [
        'label' => 'داده گاه پروپوزال',
        'url' => ['/temporary/administrative/unit2/investigation5/proposal/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند پروپوزال',
        'url' => ['/temporary/administrative/unit2/investigation5/proposal/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/temporary/administrative/unit2/investigation5/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/certificate_archived', [
   'source' => $source,
   'proposal' => $proposal,
   'report' => $report,
    'moduleId' => 'unit2',
    'baseRoute' => '/unit2/investigation5'
]);
