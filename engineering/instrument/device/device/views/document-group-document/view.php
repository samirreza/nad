<?php

$this->title = 'شناسنامه مدرک ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'ابزار دقیق',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/instrument/device/manage/index']],
    ['label' => 'لیست تجهیزات', 'url' => ['/engineering/instrument/device/device/manage']],
    ['label' => 'گروه مدارک', 'url' => ['/engineering/instrument/device/device/document-group/manage/index'],
    ['label' => 'لیست مدارک', 'url' => ['/engineering/instrument/device/device/document-group-document/index', 'groupId' => $model->groupId]]],
    $this->title
];

?>

<div class="document-view">
    <?= $this->render('@nad/common/modules/device/views/document-group-document/view', [
        'model' => $model,
        'moduleId' => 'instrument'
    ]) ?>
</div>
