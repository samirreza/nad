<?php

$this->title = 'لیست مدارک';
$this->params['siteIndex'] = ['/engineering/electricity/site/site/index'];
$this->params['breadcrumbs'] = [
    'فنی',
    'برق',
    ['label' => 'مکان ها', 'url' => ['/engineering/electricity/site/site/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/site/views/document/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
]);
