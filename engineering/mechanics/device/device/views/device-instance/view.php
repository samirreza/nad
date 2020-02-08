<?php

$this->title = 'شناسنامه تجهیز';
$this->params['breadcrumbs'] = [
    'فنی',
    'مکانیک',
    ['label' => 'لیست تجهیزات', 'url' => ['/engineering/mechanics/device/device/manage/index']],
    $this->title
];

?>

<div class="site-view">
    <?= $this->render('@nad/common/modules/device/views/device-instance/view', [
        'model' => $model
    ]) ?>
</div>
