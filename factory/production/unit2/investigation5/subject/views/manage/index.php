<?php

$this->title = 'لیست موضوع های فعال';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'تولید',
    ['label' => 'واحد 2', 'url' => ['/factory/production/unit2/manage/index']],
    ['label' => 'فعالیت ه', 'url' => ['/factory/production/unit2/manage/investigation5']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/subject/views/subject/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
