<?php

$this->title = 'شناسنامه ' . $subject->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'مواد',
    ['label' => 'ضدرسوب', 'url' => ['/antisediment/manage/index']],
    ['label' => 'مطالعات کلی و دستورالعمل ها', 'url' => ['/antisediment/manage/investigation-design']],
    ['label' => 'لیست موضوع های فعال', 'url' => ['index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/subject/views/subject/certificate', [
    'subject' => $subject,
    'moduleId' => 'antisediment',
    'baseRoute' => '/antisediment/investigationDesign'
]);
