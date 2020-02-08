<?php

$this->title = 'لیست مکان ها';
// $this->params['stageCategoriesIndex'] = ['/engineering/construction/stage/category/index'];
$this->params['breadcrumbs'] = [
    'فنی',
    'ساختمان',
    ['label' => 'مکان ها', 'url' => ['/engineering/construction/site/site/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/site/views/site/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
]);
