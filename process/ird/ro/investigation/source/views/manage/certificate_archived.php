<?php

$this->title = 'شناسنامه ' . $source->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'آر او', 'url' => ['/process/ird/ro/manage/index']],
    ['label' => 'بررسی فرایندی', 'url' => ['/process/ird/ro/manage/investigation']],
    'داده گاه منشا',
    ['label' => 'لیست داده گاه منشا', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه منشا',
        'url' => ['/process/ird/ro/investigation/source/manage/index']
    ],
    [
        'label' => 'داده گاه منشا',
        'url' => ['/process/ird/ro/investigation/source/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند منشا',
        'url' => ['/process/ird/ro/investigation/source/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/process/ird/ro/investigation/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/source/views/source/certificate_archived', [
    'source' => $source,
    'moduleId' => 'ro',
    'baseRoute' => '/process/ird/ro/investigation'
]);
