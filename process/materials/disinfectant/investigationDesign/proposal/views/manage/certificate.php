<?php

$this->title = 'شناسنامه ' . $proposal->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'گندزدا', 'url' => ['/disinfectant/manage/index']],
    ['label' => 'مطالعات کلی و دستورالعمل ها', 'url' => ['/disinfectant/manage/investigation-design']],
    ['label' => 'لیست پروپوزال', 'url' => ['index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/certificate', [
    'source' => $source,
    'proposal' => $proposal,
    'report' => $report,
    'moduleId' => 'disinfectant',
    'baseRoute' => '/disinfectant/investigationDesign'
]);
