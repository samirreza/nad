<?php

$this->title = 'لیست مدارک';
$this->params['siteIndex'] = ['/engineering/control/site/site/index'];
$this->params['breadcrumbs'] = [
    'فنی',
    'کنترل',
    ['label' => 'مکان ها', 'url' => ['/engineering/control/site/site/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/site/views/document/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
]);
