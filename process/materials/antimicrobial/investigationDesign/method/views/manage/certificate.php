<?php

$this->title = 'شناسنامه ' . $method->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'ضدمیکروب', 'url' => ['/antimicrobial/manage/index']],
    ['label' => 'مطالعات کلی و دستورالعمل ها', 'url' => ['/antimicrobial/manage/investigation-design']],
    ['label' => 'لیست روش', 'url' => ['index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/method/views/method/certificate', [
    'source' => $source,
    'proposal' => $proposal,
    'report' => $report,
    'method' => $method,
    'moduleId' => 'antimicrobial',
    'baseRoute' => '/antimicrobial/investigationDesign'
]);
