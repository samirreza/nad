<?php

$this->title = 'شناسنامه ' . $proposal->title;
$this->params['breadcrumbs'] = [
    'موقت',
    'تامین',
    ['label' => 'واحد 2', 'url' => ['/temporary/supply/unit2/manage/index']],
    ['label' => 'فعالیت ه', 'url' => ['/temporary/supply/unit2/manage/investigation5']],
    ['label' => 'لیست پروپوزال', 'url' => ['index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/certificate', [
    'source' => $source,
    'proposal' => $proposal,
    'report' => $report,
    'moduleId' => 'unit2',
    'baseRoute' => '/unit2/investigation5'
]);
