<?php

$this->title = 'رده‌بندی دستورالعملها';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'تولید',
    ['label' => 'واحد 2', 'url' => ['/factory/production/unit2/manage/index']],
    ['label' => 'فعالیت الف', 'url' => ['/factory/production/unit2/manage/investigation1']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/instruction/views/category/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);