<?php

$this->title = 'شناسنامه ' . $report->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'مواد',
    ['label' => 'رنگ ها', 'url' => ['/colors/manage/index']],
    ['label' => 'بررسی', 'url' => ['/colors/manage/investigation']],
    ['label' => 'لیست گزارش', 'url' => ['index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/certificate', [
    'source' => $source,
    'proposal' => $proposal,
    'report' => $report,
    'moduleId' => 'colors',
    'baseRoute' => '/colors/investigation'
]);
