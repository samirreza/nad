<?php

$this->title = 'لیست مدارک';
$this->params['siteIndex'] = ['/engineering/piping/site/site/index'];
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'مکان ها', 'url' => ['/engineering/piping/site/site/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/site/views/document/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
]);
