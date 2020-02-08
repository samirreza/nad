<?php

$this->title = 'لیست مدارک';
$this->params['breadcrumbs'] = [
    'فنی',
    'ژئوتکنیک',
    ['label' => 'لیست مکان ها', 'url' => ['/engineering/geotechnics/site/site/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/site/views/document/tree');