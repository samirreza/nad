<?php

$this->title = 'شناسنامه مدرک ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'ابزار دقیق',
    ['label' => 'مراحل', 'url' => ['/engineering/instrument/stage/manage/index']],
    ['label' => 'لیست مراحل', 'url' => ['/engineering/instrument/stage/category']],
    ['label' => 'گروه مدارک', 'url' => ['/engineering/instrument/location/manage/index'],
    ['label' => 'لیست مدارک', 'url' => ['/engineering/instrument/document/manage/index', 'groupId' => $model->groupId]]],
    $this->title
];

?>

<div class="document-view">
    <?= $this->render('@nad/common/modules/engineering/document/views/manage/view', [
        'model' => $model,
        'moduleId' => 'instrument'
    ]) ?>
</div>
