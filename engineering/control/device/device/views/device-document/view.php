<?php

$this->title = 'روند مدرک';
$this->params['breadcrumbs'] = [
    'فنی',
    'کنترل',
    ['label' => 'لیست تجهیزات', 'url' => ['/engineering/control/device/device/manage/index']],
    $this->title
];

?>

<div class="document-view">
    <?= $this->render('@nad/common/modules/device/views/device-document/view', [
        'model' => $model
    ]) ?>
</div>
