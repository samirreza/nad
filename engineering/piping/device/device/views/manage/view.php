<?php

$this->title = 'شناسنامه تجهیز';
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'لیست تجهیزات', 'url' => ['/engineering/piping/device/device/manage/index']],
    $this->title
];

?>

<div class="site-view">
    <?= $this->render('@nad/common/modules/device/views/manage/view', [
        'model' => $model
    ]) ?>
</div>
