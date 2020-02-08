<?php

$this->title = 'لیست گروه های مدارک';
$this->params['stageCategoriesIndex'] = ['/engineering/electricity/stage/category/index'];
$this->params['breadcrumbs'] = [
    'فنی',
    'برق',
    ['label' => 'مراحل', 'url' => ['/engineering/electricity/stage/manage/index']],
    ['label' => 'لیست مراحل', 'url' => ['/engineering/electricity/stage/category']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/engineering/location/views/manage/tree');