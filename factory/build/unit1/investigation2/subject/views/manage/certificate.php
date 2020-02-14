<?php

$this->title = 'شناسنامه ' . $subject->title;
$this->params['breadcrumbs'] = [
    'کارخانه',
    'احداث',
    ['label' => 'واحد 1', 'url' => ['/factory/build/unit1/manage/index']],
    ['label' => 'فعالیت ب', 'url' => ['/factory/build/unit1/manage/investigation2']],
    ['label' => 'لیست موضوع های فعال', 'url' => ['index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/subject/views/subject/certificate', [
    'subject' => $subject,
    'moduleId' => 'unit1',
    'baseRoute' => '/factory/build/unit1/investigation2'
]);
