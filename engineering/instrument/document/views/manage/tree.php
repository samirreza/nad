<?php

$this->title = 'لیست گروه های مدارک';
$this->params['stageCategoriesIndex'] = ['/engineering/instrument/stage/category/index'];
$this->params['breadcrumbs'] = [
    'فنی',
    'ابزار دقیق',
    ['label' => 'مراحل', 'url' => ['/engineering/instrument/stage/manage/index']],
    ['label' => 'لیست مراحل', 'url' => ['/engineering/instrument/stage/category']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/engineering/location/views/manage/tree');