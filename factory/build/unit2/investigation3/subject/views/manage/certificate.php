<?php

$this->title = 'شناسنامه ' . $subject->title;
$this->params['breadcrumbs'] = [
    'کارخانه',
    'احداث',
    ['label' => 'واحد 2', 'url' => ['/factory/build/unit2/manage/index']],
    ['label' => 'فعالیت ج', 'url' => ['/factory/build/unit2/manage/investigation3']],
    ['label' => 'لیست موضوع های فعال', 'url' => ['index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/subject/views/subject/certificate', [
    'subject' => $subject,
    'moduleId' => 'unit2',
    'baseRoute' => '/factory/build/unit2/investigation3'
]);
