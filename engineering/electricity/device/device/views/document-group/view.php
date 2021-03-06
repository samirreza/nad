<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'برق',
    ['label' => 'مراحل', 'url' => ['/engineering/electricity/device/manage/index']],
    ['label' => 'لیست گروه های مدارک', 'url' => ['/engineering/electricity/device/manage/index']],
    $this->title
];

?>

<div class="device-view">
    <?= $this->render('@nad/common/modules/device/views/document-group/view', [
        'model' => $model,
        'moduleId' => 'electricity'
    ]) ?>
</div>
