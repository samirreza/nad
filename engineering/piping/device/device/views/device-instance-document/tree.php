<?php

$this->title = 'لیست مدارک';
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'لیست تجهیزات', 'url' => ['/engineering/piping/device/device/manage/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/device/device/views/device-document/tree');