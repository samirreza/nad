<?php

$this->title = 'شناسنامه ' . $report->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'ته نشینی', 'url' => ['/sedimentation/manage/index']],
    ['label' => 'بررسی', 'url' => ['/sedimentation/manage/investigation']],
    ['label' => 'لیست گزارش', 'url' => ['index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/certificate', [
    'source' => $source,
    'proposal' => $proposal,
    'report' => $report,
    'moduleId' => 'sedimentation',
    'baseRoute' => '/sedimentation/investigation'
]);
