<?php

$this->title = 'لیست دستورالعمل';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'تولید',
    ['label' => 'فنی', 'url' => ['/factory/production/unit1/manage/index']],
    ['label' => 'فعالیت ه', 'url' => ['/factory/production/unit1/manage/investigation5']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/instruction/views/instruction/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
