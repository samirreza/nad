<?php

$this->title = 'لیست مدارک';
$this->params['siteIndex'] = ['/engineering/construction/site/site/index'];
$this->params['breadcrumbs'] = [
    'فنی',
    'ساختمان',
    ['label' => 'مکان ها', 'url' => ['/engineering/construction/site/site/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/site/views/document/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
]);
