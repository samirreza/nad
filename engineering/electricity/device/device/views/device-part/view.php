<?php

$this->title = 'شناسنامه تجهیز';
$this->params['breadcrumbs'] = [
    'فنی',
    'برق',
    ['label' => 'لیست تجهیزات', 'url' => ['/engineering/electricity/device/device/manage/index']],
    $this->title
];

?>

<div class="site-view">
    <?= $this->render('@nad/common/modules/device/views/device-part/view', [
        'model' => $model
    ]) ?>
</div>
