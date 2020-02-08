<?php

$this->title = 'لیست مکان ها';
// $this->params['stageCategoriesIndex'] = ['/engineering/control/stage/category/index'];
$this->params['breadcrumbs'] = [
    'فنی',
    'کنترل',
    ['label' => 'لیست مکان ها', 'url' => ['/engineering/control/site/site/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/site/views/site/tree');