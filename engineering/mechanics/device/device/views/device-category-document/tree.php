<?php

$this->title = 'لیست مدارک';
$this->params['breadcrumbs'] = [
    'فنی',
    'مکانیک',
    ['label' => 'لیست تجهیزات', 'url' => ['/engineering/mechanics/device/device/manage/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/device/device/views/device-category-document/tree');