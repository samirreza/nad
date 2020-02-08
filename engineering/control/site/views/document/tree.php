<?php

$this->title = 'لیست مدارک';
$this->params['breadcrumbs'] = [
    'فنی',
    'کنترل',
    ['label' => 'لیست مکان ها', 'url' => ['/engineering/control/site/site/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/site/views/document/tree');