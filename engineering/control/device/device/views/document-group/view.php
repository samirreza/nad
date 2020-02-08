<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'کنترل',
    ['label' => 'مراحل', 'url' => ['/engineering/control/device/manage/index']],
    ['label' => 'لیست گروه های مدارک', 'url' => ['/engineering/control/device/manage/index']],
    $this->title
];

?>

<div class="device-view">
    <?= $this->render('@nad/common/modules/device/views/document-group/view', [
        'model' => $model,
        'moduleId' => 'control'
    ]) ?>
</div>
