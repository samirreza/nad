<?php

$this->title = 'شناسنامه ' . $subject->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'مواد',
    ['label' => 'منعقدکننده', 'url' => ['/process/materials/coagulant/manage/index']],
    ['label' => 'مطالعات کلی و دستورالعمل ها', 'url' => ['/process/materials/coagulant/manage/investigation-design']],
    ['label' => 'لیست موضوع های فعال', 'url' => ['index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/subject/views/subject/certificate', [
    'subject' => $subject,
    'moduleId' => 'coagulant',
    'baseRoute' => '/process/materials/coagulant/investigationDesign'
]);
