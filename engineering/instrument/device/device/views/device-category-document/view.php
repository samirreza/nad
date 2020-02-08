<?php

$this->title = 'روند مدرک';
$this->params['breadcrumbs'] = [
    'فنی',
    'ابزار دقیق',
    ['label' => 'لیست تجهیزات', 'url' => ['/engineering/instrument/device/device/manage/index']],
    $this->title
];

?>

<div class="document-view">
    <?= $this->render('@nad/common/modules/device/views/device-category-document/view', [
        'model' => $model
    ]) ?>
</div>
