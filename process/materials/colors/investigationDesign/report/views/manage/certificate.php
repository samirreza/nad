<?php

$this->title = 'شناسنامه ' . $report->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'رنگ ها', 'url' => ['/process/materials/colors/manage/index']],
    ['label' => 'بررسی', 'url' => ['/process/materials/colors/manage/investigation-design']],
    ['label' => 'لیست گزارش', 'url' => ['index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/report/views/report/certificate', [
    'source' => $source,
    'proposal' => $proposal,
    'report' => $report,
    'moduleId' => 'colors',
    'baseRoute' => '/process/materials/colors/investigationDesign'
]);
