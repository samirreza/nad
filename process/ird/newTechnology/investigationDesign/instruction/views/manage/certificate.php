<?php

$this->title = 'شناسنامه ' . $instruction->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'تکنولوژی های نو', 'url' => ['/process/ird/newTechnology/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/process/ird/newTechnology/manage/investigation-design']],
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
    'moduleId' => 'newTechnology',
    'baseRoute' => '/process/ird/newTechnology/investigationDesign'
]);
