<?php

$this->title = 'لیست مدارک';
$this->params['breadcrumbs'] = [
    'فنی',
    'برق',
    ['label' => 'لیست تجهیزات', 'url' => ['/engineering/electricity/device/device/manage/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/device/device/views/device-category-document/tree');