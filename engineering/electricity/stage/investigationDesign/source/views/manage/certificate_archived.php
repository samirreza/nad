<?php

$this->title = 'شناسنامه ' . $source->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'برق',
    ['label' => 'مراحل', 'url' => ['/engineering/electricity/stage/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/engineering/electricity/stage/manage/investigation-design']],
    'داده گاه منشا',
    ['label' => 'لیست داده گاه منشا', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه منشا',
        'url' => ['/engineering/electricity/stage/investigationDesign/source/manage/index']
    ],
    [
        'label' => 'داده گاه منشا',
        'url' => ['/engineering/electricity/stage/investigationDesign/source/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند منشا',
        'url' => ['/engineering/electricity/stage/investigationDesign/source/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/engineering/electricity/stage/investigationDesign/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/source/views/source/certificate_archived', [
    'source' => $source,
    'moduleId' => 'stage',
    'baseRoute' => '/stage/investigationDesign-monitor'
]);
