<?php

$this->title = 'شناسنامه ' . $source->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'ضدرسوب', 'url' => ['/process/materials/antisediment/manage/index']],
    ['label' => 'بررسی پایش', 'url' => ['/process/materials/antisediment/manage/investigation-monitor']],
    'داده گاه منشا',
    ['label' => 'لیست داده گاه منشا', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'لیست داده گاه منشا',
        'url' => ['/process/materials/antisediment/investigationMonitor/source/manage/archived-index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/source/views/source/certificate_archived', [
    'source' => $source,
    'moduleId' => 'antisediment',
    'baseRoute' => '/process/materials/antisediment/investigationMonitor'
]);
