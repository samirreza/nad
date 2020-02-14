<?php

$this->title = 'لیست دستورالعمل';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'تولید',
    ['label' => 'واحد 2', 'url' => ['/factory/production/unit2/manage/index']],
    ['label' => 'فعالیت ه', 'url' => ['/factory/production/unit2/manage/investigation5']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/instruction/views/instruction/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
