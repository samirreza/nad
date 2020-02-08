<?php

$this->title = 'شناسنامه مدرک ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'برق',
    ['label' => 'مراحل', 'url' => ['/engineering/electricity/stage/manage/index']],
    ['label' => 'لیست مراحل', 'url' => ['/engineering/electricity/stage/category']],
    ['label' => 'گروه مدارک', 'url' => ['/engineering/electricity/location/manage/index'],
    ['label' => 'لیست مدارک', 'url' => ['/engineering/electricity/document/manage/index', 'groupId' => $model->groupId]]],
    $this->title
];

?>

<div class="document-view">
    <?= $this->render('@nad/common/modules/engineering/document/views/manage/view', [
        'model' => $model,
        'moduleId' => 'electricity'
    ]) ?>
</div>
