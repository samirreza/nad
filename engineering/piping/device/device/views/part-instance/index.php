<?php

$this->title = 'لیست قطعات';
// $this->params['stageCategoriesIndex'] = ['/engineering/piping/stage/category/index'];
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'تجهیزات', 'url' => ['/engineering/piping/device/device/manage/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/device/views/part-instance/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
]);
