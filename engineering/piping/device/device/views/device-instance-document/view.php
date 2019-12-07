<?php

$this->title = 'روند مدرک';
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'لیست تجهیزات', 'url' => ['/engineering/piping/device/device/manage/index']],
    $this->title
];

?>

<div class="document-view">
    <?= $this->render('@nad/common/modules/device/views/device-instance-document/view', [
        'model' => $model
    ]) ?>
</div>
