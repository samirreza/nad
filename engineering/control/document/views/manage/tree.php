<?php

$this->title = 'لیست گروه های مدارک';
$this->params['stageCategoriesIndex'] = ['/engineering/control/stage/category/index'];
$this->params['breadcrumbs'] = [
    'فنی',
    'کنترل',
    ['label' => 'مراحل', 'url' => ['/engineering/control/stage/manage/index']],
    ['label' => 'لیست مراحل', 'url' => ['/engineering/control/stage/category']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/engineering/location/views/manage/tree');