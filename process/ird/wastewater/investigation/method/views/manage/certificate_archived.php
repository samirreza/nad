<?php

$this->title = 'شناسنامه ' . $method->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'پساب', 'url' => ['/wastewater/manage/index']],
    ['label' => 'بررسی فرایندی', 'url' => ['/wastewater/manage/investigation']],
    'داده گاه روش',
    ['label' => 'لیست داده گاه روش', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه روش',
        'url' => ['/wastewater/investigation/method/manage/index']
    ],
    [
        'label' => 'داده گاه روش',
        'url' => ['/wastewater/investigation/method/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند روش',
        'url' => ['/wastewater/investigation/method/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/wastewater/investigation/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/method/views/method/certificate_archived', [
   'source' => $source,
   'proposal' => $proposal,
   'report' => $report,
   'method' => $method,
    'moduleId' => 'wastewater',
    'baseRoute' => '/wastewater/investigation'
]);
