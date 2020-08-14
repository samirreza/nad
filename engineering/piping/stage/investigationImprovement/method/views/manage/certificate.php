<?php

$this->title = 'شناسنامه ' . $method->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'مراحل', 'url' => ['/engineering/piping/stage/manage/index']],
    ['label' => 'روش  و دستورالعمل', 'url' => ['/engineering/piping/stage/manage/investigation-improvement']],
    ['label' => 'لیست روش', 'url' => ['index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/method/views/method/certificate', [
    'source' => $source,
    'proposal' => $proposal,
    'report' => $report,
    'method' => $method,
    'moduleId' => 'stage',
    'baseRoute' => '/engineering/piping/stage/investigationImprovement'
]);
