<?php

$this->title = 'شناسنامه ' . $subject->title;
$this->params['breadcrumbs'] = [
    'احداث',
    'ساختمان',
    ['label' => 'واحد 1', 'url' => ['/build/construction/unit1/manage/index']],
    ['label' => 'فعالیت الف', 'url' => ['/build/construction/unit1/manage/investigation1']],
    ['label' => 'لیست موضوع های فعال', 'url' => ['index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/subject/views/subject/certificate', [
    'subject' => $subject,
    'moduleId' => 'unit1',
    'baseRoute' => '/build/construction/unit1/investigation1'
]);
