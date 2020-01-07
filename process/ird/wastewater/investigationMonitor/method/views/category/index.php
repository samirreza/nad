<?php

$this->title = 'رده‌بندی روشها';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'پساب', 'url' => ['/wastewater/manage/index']],
    ['label' => 'بررسی پایش', 'url' => ['/wastewater/manage/investigation-monitor']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/method/views/category/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
