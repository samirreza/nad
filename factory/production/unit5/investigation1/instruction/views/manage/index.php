<?php

$this->title = 'لیست دستورالعمل';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'تولید',
    ['label' => 'انبار', 'url' => ['/factory/production/unit5/manage/index']],
    ['label' => 'فعالیت الف', 'url' => ['/factory/production/unit5/manage/investigation1']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/instruction/views/instruction/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
