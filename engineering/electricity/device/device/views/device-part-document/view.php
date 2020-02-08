<?php

$this->title = 'روند مدرک';
$this->params['breadcrumbs'] = [
    'فنی',
    'برق',
    ['label' => 'لیست تجهیزات', 'url' => ['/engineering/electricity/device/device/manage/index']],
    $this->title
];

?>

<div class="document-view">
    <?= $this->render('@nad/common/modules/device/views/device-part-document/view', [
        'model' => $model
    ]) ?>
</div>
