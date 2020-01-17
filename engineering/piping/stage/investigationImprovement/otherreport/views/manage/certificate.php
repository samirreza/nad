<?php

$this->title = 'شناسنامه ' . $otherreport->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'مراحل', 'url' => ['/engineering/piping/stage/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/piping/stage/manage/investigation-improvement']],
    ['label' => 'لیست گزارش', 'url' => ['index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/otherreport/views/otherreport/certificate', [
    'subject' => $subject,
    'otherreport' => $otherreport,
    'moduleId' => 'stage',
    'baseRoute' => '/engineering/piping/stage/investigationImprovement'
]);
