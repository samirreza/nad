<?php

$this->title = 'لیست قطعات';
// $this->params['stageCategoriesIndex'] = ['/engineering/construction/stage/category/index'];
$this->params['breadcrumbs'] = [
    'فنی',
    'ساختمان',
    ['label' => 'تجهیزات', 'url' => ['/engineering/construction/device/device/manage/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/device/views/part-instance/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'partModel' => $partModel
]);
