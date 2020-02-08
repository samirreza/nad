<?php

$this->title = 'شناسنامه تجهیز';
$this->params['breadcrumbs'] = [
    'فنی',
    'کنترل',
    ['label' => 'لیست تجهیزات', 'url' => ['/engineering/control/device/device/manage/index']],
    $this->title
];

?>

<div class="site-view">
    <?= $this->render('@nad/common/modules/device/views/device-part/view', [
        'model' => $model
    ]) ?>
</div>
