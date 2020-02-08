<?php

$this->title = 'لیست مکان ها';
// $this->params['stageCategoriesIndex'] = ['/engineering/electricity/stage/category/index'];
$this->params['breadcrumbs'] = [
    'فنی',
    'برق',
    ['label' => 'لیست مکان ها', 'url' => ['/engineering/electricity/site/site/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/site/views/site/tree');