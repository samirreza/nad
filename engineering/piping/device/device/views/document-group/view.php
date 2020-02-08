<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'مراحل', 'url' => ['/engineering/piping/device/manage/index']],
    ['label' => 'لیست گروه های مدارک', 'url' => ['/engineering/piping/device/manage/index']],
    $this->title
];

?>

<div class="device-view">
    <?= $this->render('@nad/common/modules/device/views/document-group/view', [
        'model' => $model,
        'moduleId' => 'piping'
    ]) ?>
</div>
