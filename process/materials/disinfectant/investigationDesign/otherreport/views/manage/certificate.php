<?php

$this->title = 'شناسنامه ' . $otherreport->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'مراحل', 'url' => ['/process/materials/disinfectant/manage/index']],
    ['label' => 'مطالعات کلی و دستورالعمل ها', 'url' => ['/process/materials/disinfectant/manage/investigation-design']],
    ['label' => 'لیست گزارش', 'url' => ['index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/otherreport/views/otherreport/certificate', [
    'subject' => $subject,
    'otherreport' => $otherreport,
    'moduleId' => 'disinfectant',
    'baseRoute' => '/disinfectant/investigationDesign'
]);
