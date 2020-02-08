<?php

$this->title = 'شناسنامه ' . $source->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'ساختمان',
    ['label' => 'مراحل', 'url' => ['/engineering/construction/stage/manage/index']],
    ['label' => 'بررسی روشهای پایش', 'url' => ['/engineering/construction/stage/manage/investigation-monitor-methods']],
    'برنامه منشا',
    ['label' => 'لیست منشاهای برنامه', 'url' => ['index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/source/views/source/certificate', [
    'source' => $source,
    'moduleId' => 'stage',
    'baseRoute' => '/stage/investigationMonitorMethods'
]);
