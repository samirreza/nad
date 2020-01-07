<?php

$this->title = 'رده‌بندی روشها';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'تکنولوژی های نو', 'url' => ['/newTechnology/manage/index']],
    ['label' => 'بررسی پایش', 'url' => ['/newTechnology/manage/investigation-monitor']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/method/views/category/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
