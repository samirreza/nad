<?php

$this->title = 'شناسنامه مدرک ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'ساختمان',
    ['label' => 'مراحل', 'url' => ['/engineering/construction/stage/manage/index']],
    ['label' => 'لیست مراحل', 'url' => ['/engineering/construction/stage/category']],
    ['label' => 'گروه مدارک', 'url' => ['/engineering/construction/location/manage/index'],
    ['label' => 'لیست مدارک', 'url' => ['/engineering/construction/document/manage/index', 'groupId' => $model->groupId]]],
    $this->title
];

?>

<div class="document-view">
    <?= $this->render('@nad/common/modules/engineering/document/views/manage/view', [
        'model' => $model,
        'moduleId' => 'construction'
    ]) ?>
</div>
