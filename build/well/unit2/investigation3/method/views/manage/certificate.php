<?php

$this->title = 'شناسنامه ' . $method->title;
$this->params['breadcrumbs'] = [
    'احداث',
    'چاه',
    ['label' => 'واحد 2', 'url' => ['/build/well/unit2/manage/index']],
    ['label' => 'فعالیت ج', 'url' => ['/build/well/unit2/manage/investigation3']],
    ['label' => 'لیست روش', 'url' => ['index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/method/views/method/certificate', [
    'source' => $source,
    'proposal' => $proposal,
    'report' => $report,
    'method' => $method,
    'moduleId' => 'unit2',
    'baseRoute' => '/build/well/unit2/investigation3'
]);
