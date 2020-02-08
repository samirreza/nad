<?php

$this->title = 'شناسنامه تجهیز';
$this->params['breadcrumbs'] = [
    'فنی',
    'ژئوتکنیک',
    ['label' => 'لیست تجهیزات', 'url' => ['/engineering/geotechnics/device/device/manage/index']],
    $this->title
];

?>

<div class="site-view">
    <?= $this->render('@nad/common/modules/device/views/part-instance/view', [
        'model' => $model
    ]) ?>
</div>
