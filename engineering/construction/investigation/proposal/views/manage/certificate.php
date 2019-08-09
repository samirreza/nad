<?php

$this->title = 'شناسنامه ' . $proposal->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'بررسی، پایش و طراحی',
    ['label' => 'ساختمان', 'url' => ['/engineering/construction/manage/index']],
    ['label' => 'بررسی', 'url' => ['/engineering/construction/manage/investigation']],
    ['label' => 'لیست پروپوزال', 'url' => ['index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/certificate', [
    'source' => $source,
    'proposal' => $proposal,
    'report' => $report,
    'moduleId' => 'construction',
    'baseRoute' => '/construction/investigation'
]);
