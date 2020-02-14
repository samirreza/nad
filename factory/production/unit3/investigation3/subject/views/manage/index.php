<?php

$this->title = 'لیست موضوع های فعال';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'تولید',
    ['label' => 'واحد 3', 'url' => ['/factory/production/unit3/manage/index']],
    ['label' => 'فعالیت ج', 'url' => ['/factory/production/unit3/manage/investigation3']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/subject/views/subject/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
