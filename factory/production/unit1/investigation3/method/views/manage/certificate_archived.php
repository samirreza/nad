<?php

$this->title = 'شناسنامه ' . $method->title;
$this->params['breadcrumbs'] = [
    'کارخانه',
    'تولید',
    ['label' => 'واحد 1', 'url' => ['/factory/production/unit1/manage/index']],
    ['label' => 'فعالیت ج', 'url' => ['/factory/production/unit1/manage/investigation3']],
    'داده گاه روش',
    ['label' => 'لیست داده گاه روش', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه روش',
        'url' => ['/factory/production/unit1/investigation3/method/manage/index']
    ],
    [
        'label' => 'داده گاه روش',
        'url' => ['/factory/production/unit1/investigation3/method/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند روش',
        'url' => ['/factory/production/unit1/investigation3/method/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/factory/production/unit1/investigation3/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/method/views/method/certificate_archived', [
   'source' => $source,
   'proposal' => $proposal,
   'report' => $report,
   'method' => $method,
    'moduleId' => 'unit1',
    'baseRoute' => '/unit1/investigation3'
]);
