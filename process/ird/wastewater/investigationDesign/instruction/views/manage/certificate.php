<?php

$this->title = 'شناسنامه ' . $instruction->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'پساب', 'url' => ['/process/ird/wastewater/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/process/ird/wastewater/manage/investigation-design']],
    ['label' => 'لیست دستورالعمل', 'url' => ['index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/instruction/views/instruction/certificate', [
    'source' => $source,
    'proposal' => $proposal,
    'report' => $report,
    'method' => $method,
    'instruction' => $instruction,
    'moduleId' => 'wastewater',
    'baseRoute' => '/process/ird/wastewater/investigationDesign'
]);
