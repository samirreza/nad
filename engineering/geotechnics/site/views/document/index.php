<?php

$this->title = 'لیست مدارک';
$this->params['siteIndex'] = ['/engineering/geotechnics/site/site/index'];
$this->params['breadcrumbs'] = [
    'فنی',
    'ژئوتکنیک',
    ['label' => 'مکان ها', 'url' => ['/engineering/geotechnics/site/site/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/site/views/document/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
]);
