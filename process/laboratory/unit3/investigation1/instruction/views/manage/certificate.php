<?php

$this->title = 'شناسنامه ' . $instruction->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'آزمایشگاه',
    ['label' => 'تجهیزات آزمایشگاهی', 'url' => ['/process/laboratory/unit3/manage/index']],
    ['label' => 'فعالیت بررسی', 'url' => ['/process/laboratory/unit3/manage/investigation1']],
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
    'moduleId' => 'unit3',
    'baseRoute' => '/process/laboratory/unit3/investigation1'
]);
