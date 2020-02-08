<?php

$this->title = 'لیست مدارک';
$this->params['breadcrumbs'] = [
    'فنی',
    'کنترل',
    ['label' => 'لیست تجهیزات', 'url' => ['/engineering/control/device/device/manage/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/device/device/views/device-document/tree');