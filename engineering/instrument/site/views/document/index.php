<?php

$this->title = 'لیست مدارک';
$this->params['siteIndex'] = ['/engineering/instrument/site/site/index'];
$this->params['breadcrumbs'] = [
    'فنی',
    'ابزار دقیق',
    ['label' => 'مکان ها', 'url' => ['/engineering/instrument/site/site/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/site/views/document/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
]);
