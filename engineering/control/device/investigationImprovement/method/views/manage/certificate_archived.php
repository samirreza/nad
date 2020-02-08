<?php

$this->title = 'شناسنامه ' . $method->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'کنترل',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/control/device/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/control/device/manage/investigation-improvement']],
    'داده گاه روش',
    ['label' => 'لیست داده گاه روش', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه روش',
        'url' => ['/engineering/control/device/investigationImprovement/method/manage/index']
    ],
    [
        'label' => 'داده گاه روش',
        'url' => ['/engineering/control/device/investigationImprovement/method/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند روش',
        'url' => ['/engineering/control/device/investigationImprovement/method/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/engineering/control/device/investigationImprovement/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/method/views/method/certificate_archived', [
   'source' => $source,
   'proposal' => $proposal,
   'report' => $report,
   'method' => $method,
    'moduleId' => 'device',
    'baseRoute' => '/device/investigationImprovement'
]);
