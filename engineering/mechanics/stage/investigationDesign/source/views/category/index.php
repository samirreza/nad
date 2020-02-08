<?php

$this->title = 'رده‌بندی منشا';
$this->params['breadcrumbs'] = [
    'فنی',
    'مکانیک',
    ['label' => 'مراحل', 'url' => ['/engineering/mechanics/stage/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/engineering/mechanics/stage/manage/investigation-design']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/source/views/category/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
