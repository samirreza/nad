<?php

$this->title = 'شناسنامه ' . $source->title;
$this->params['breadcrumbs'] = [
    'کارخانه',
    'تولید',
    ['label' => 'تولید', 'url' => ['/factory/production/unit3/manage/index']],
    ['label' => 'فعالیت ب', 'url' => ['/factory/production/unit3/manage/investigation2']],
    'داده گاه منشا',
    ['label' => 'لیست داده گاه منشا', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه منشا',
        'url' => ['/factory/production/unit3/investigation2/source/manage/index']
    ],
    [
        'label' => 'داده گاه منشا',
        'url' => ['/factory/production/unit3/investigation2/source/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند منشا',
        'url' => ['/factory/production/unit3/investigation2/source/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/factory/production/unit3/investigation2/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/source/views/source/certificate_archived', [
    'source' => $source,
    'moduleId' => 'unit3',
    'baseRoute' => '/unit3/investigation2'
]);
