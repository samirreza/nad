<?php

$this->title = 'لیست مکان ها';
// $this->params['stageCategoriesIndex'] = ['/engineering/instrument/stage/category/index'];
$this->params['breadcrumbs'] = [
    'فنی',
    'ابزار دقیق',
    ['label' => 'مکان ها', 'url' => ['/engineering/instrument/site/site/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/site/views/site/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
]);
