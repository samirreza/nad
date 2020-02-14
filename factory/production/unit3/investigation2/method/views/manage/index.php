<?php

$this->title = 'لیست روش';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'تولید',
    ['label' => 'واحد 3', 'url' => ['/factory/production/unit3/manage/index']],
    ['label' => 'فعالیت ب', 'url' => ['/factory/production/unit3/manage/investigation2']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/method/views/method/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
