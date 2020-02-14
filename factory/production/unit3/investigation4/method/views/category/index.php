<?php

$this->title = 'رده‌بندی روشها';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'تولید',
    ['label' => 'واحد 3', 'url' => ['/factory/production/unit3/manage/index']],
    ['label' => 'فعالیت د', 'url' => ['/factory/production/unit3/manage/investigation4']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/method/views/category/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
