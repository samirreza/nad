<?php

$this->title = 'شناسنامه مدرک ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'کنترل',
    ['label' => 'مراحل', 'url' => ['/engineering/control/stage/manage/index']],
    ['label' => 'لیست مراحل', 'url' => ['/engineering/control/stage/category']],
    ['label' => 'گروه مدارک', 'url' => ['/engineering/control/location/manage/index'],
    ['label' => 'لیست مدارک', 'url' => ['/engineering/control/document/manage/index', 'groupId' => $model->groupId]]],
    $this->title
];

?>

<div class="document-view">
    <?= $this->render('@nad/common/modules/engineering/document/views/manage/view', [
        'model' => $model,
        'moduleId' => 'control'
    ]) ?>
</div>
