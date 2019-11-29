<?php

$this->title = 'لیست مدارک';
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'لیست مکان ها', 'url' => ['/engineering/piping/site/site/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/site/views/document/tree');