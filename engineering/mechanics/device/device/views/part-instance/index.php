<?php

$this->title = 'لیست قطعات';
// $this->params['stageCategoriesIndex'] = ['/engineering/mechanics/stage/category/index'];
$this->params['breadcrumbs'] = [
    'فنی',
    'مکانیک',
    ['label' => 'تجهیزات', 'url' => ['/engineering/mechanics/device/device/manage/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/device/views/part-instance/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'partModel' => $partModel
]);
