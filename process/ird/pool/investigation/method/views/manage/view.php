<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'استخر', 'url' => ['/pool/manage/index']],
    ['label' => 'بررسی', 'url' => ['/pool/manage/investigation']],
    ['label' => 'لیست روش‌ها', 'url' => ['index']],
    $this->title
];

?>

<div class="method-view">
    <?= $this->render('@nad/common/modules/investigation/method/views/method/view', [
        'model' => $model,
        'moduleId' => 'method'
    ]) ?>
</div>
