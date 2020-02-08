<?php

$this->title = 'لیست مکان ها';
// $this->params['stageCategoriesIndex'] = ['/engineering/mechanics/stage/category/index'];
$this->params['breadcrumbs'] = [
    'فنی',
    'مکانیک',
    ['label' => 'لیست مکان ها', 'url' => ['/engineering/mechanics/site/site/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/site/views/site/tree');