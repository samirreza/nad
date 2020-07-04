<?php

$this->title = 'شناسنامه ' . $source->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'ضدمیکروب', 'url' => ['/process/materials/antimicrobial/manage/index']],
    ['label' => 'بررسی پایش', 'url' => ['/process/materials/antimicrobial/manage/investigation-monitor']],
    'داده گاه منشا',
    ['label' => 'لیست داده گاه منشا', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'لیست داده گاه منشا',
        'url' => ['/process/materials/antimicrobial/investigationMonitor/source/manage/archived-index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/source/views/source/certificate_archived', [
    'source' => $source,
    'moduleId' => 'antimicrobial',
    'baseRoute' => '/antimicrobial/investigationMonitor'
]);
