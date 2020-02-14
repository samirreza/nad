<?php

$this->title = 'شناسنامه ' . $method->title;
$this->params['breadcrumbs'] = [
    'کارخانه',
    'پشتیبانی',
    ['label' => 'واحد 2', 'url' => ['/factory/support/unit2/manage/index']],
    ['label' => 'فعالیت الف', 'url' => ['/factory/support/unit2/manage/investigation1']],
    'داده گاه روش',
    ['label' => 'لیست داده گاه روش', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه روش',
        'url' => ['/factory/support/unit2/investigation1/method/manage/index']
    ],
    [
        'label' => 'داده گاه روش',
        'url' => ['/factory/support/unit2/investigation1/method/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند روش',
        'url' => ['/factory/support/unit2/investigation1/method/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/factory/support/unit2/investigation1/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/method/views/method/certificate_archived', [
   'source' => $source,
   'proposal' => $proposal,
   'report' => $report,
   'method' => $method,
    'moduleId' => 'unit2',
    'baseRoute' => '/unit2/investigation1'
]);
