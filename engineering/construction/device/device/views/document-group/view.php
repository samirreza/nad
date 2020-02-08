<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'ساختمان',
    ['label' => 'مراحل', 'url' => ['/engineering/construction/device/manage/index']],
    ['label' => 'لیست گروه های مدارک', 'url' => ['/engineering/construction/device/manage/index']],
    $this->title
];

?>

<div class="device-view">
    <?= $this->render('@nad/common/modules/device/views/document-group/view', [
        'model' => $model,
        'moduleId' => 'construction'
    ]) ?>
</div>
