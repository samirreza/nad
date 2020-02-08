<?php

$this->title = 'شناسنامه تجهیز';
$this->params['breadcrumbs'] = [
    'فنی',
    'ابزار دقیق',
    ['label' => 'لیست تجهیزات', 'url' => ['/engineering/instrument/device/device/manage/index']],
    $this->title
];

?>

<div class="site-view">
    <?= $this->render('@nad/common/modules/device/views/part-instance/view', [
        'model' => $model
    ]) ?>
</div>
