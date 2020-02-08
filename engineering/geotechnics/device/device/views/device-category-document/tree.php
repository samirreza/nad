<?php

$this->title = 'لیست مدارک';
$this->params['breadcrumbs'] = [
    'فنی',
    'ژئوتکنیک',
    ['label' => 'لیست تجهیزات', 'url' => ['/engineering/geotechnics/device/device/manage/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/device/device/views/device-category-document/tree');