<?php

$this->title = 'لیست دستورالعمل';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'پشتیبانی',
    ['label' => 'واحد 2', 'url' => ['/factory/support/unit2/manage/index']],
    ['label' => 'فعالیت الف', 'url' => ['/factory/support/unit2/manage/investigation1']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/instruction/views/instruction/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
