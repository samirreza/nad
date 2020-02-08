<?php

$this->title = 'رده‌بندی روشها';
$this->params['breadcrumbs'] = [
    'فنی',
    'برق',
    ['label' => 'مراحل', 'url' => ['/engineering/electricity/stage/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/engineering/electricity/stage/manage/investigation-design']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/method/views/category/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
