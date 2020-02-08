<?php

$this->title = 'لیست مدارک';
$this->params['breadcrumbs'] = [
    'فنی',
    'ابزار دقیق',
    ['label' => 'لیست مکان ها', 'url' => ['/engineering/instrument/site/site/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/site/views/document/tree');