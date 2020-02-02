<?php

$this->title = 'شناسنامه ' . $method->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'منعقدکننده', 'url' => ['/coagulant/manage/index']],
    ['label' => 'مطالعات کلی و دستورالعمل ها', 'url' => ['/coagulant/manage/investigation-design']],
    ['label' => 'لیست روش', 'url' => ['index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/method/views/method/certificate', [
    'source' => $source,
    'proposal' => $proposal,
    'report' => $report,
    'method' => $method,
    'moduleId' => 'coagulant',
    'baseRoute' => '/coagulant/investigationDesign'
]);
