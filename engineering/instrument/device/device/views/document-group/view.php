<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'ابزار دقیق',
    ['label' => 'مراحل', 'url' => ['/engineering/instrument/device/manage/index']],
    ['label' => 'لیست گروه های مدارک', 'url' => ['/engineering/instrument/device/manage/index']],
    $this->title
];

?>

<div class="device-view">
    <?= $this->render('@nad/common/modules/device/views/document-group/view', [
        'model' => $model,
        'moduleId' => 'instrument'
    ]) ?>
</div>
