<?php

$this->title = 'شناسنامه ' . $subject->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'فیلتر', 'url' => ['/process/ird/filter/manage/index']],
    ['label' => 'سایرگزارشها', 'url' => ['/process/ird/filter/manage/investigation']],
    ['label' => 'لیست موضوع های فعال', 'url' => ['index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/subject/views/subject/certificate', [
    'subject' => $subject,
    'moduleId' => 'filter',
    'baseRoute' => '/process/ird/filter/investigation'
]);
