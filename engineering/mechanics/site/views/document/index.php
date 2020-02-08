<?php

$this->title = 'لیست مدارک';
$this->params['siteIndex'] = ['/engineering/mechanics/site/site/index'];
$this->params['breadcrumbs'] = [
    'فنی',
    'مکانیک',
    ['label' => 'مکان ها', 'url' => ['/engineering/mechanics/site/site/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/site/views/document/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
]);
