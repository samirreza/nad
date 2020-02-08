<?php

$this->title = 'شناسنامه مدرک ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'مکانیک',
    ['label' => 'مراحل', 'url' => ['/engineering/mechanics/stage/manage/index']],
    ['label' => 'لیست مراحل', 'url' => ['/engineering/mechanics/stage/category']],
    ['label' => 'گروه مدارک', 'url' => ['/engineering/mechanics/location/manage/index'],
    ['label' => 'لیست مدارک', 'url' => ['/engineering/mechanics/document/manage/index', 'groupId' => $model->groupId]]],
    $this->title
];

?>

<div class="document-view">
    <?= $this->render('@nad/common/modules/engineering/document/views/manage/view', [
        'model' => $model,
        'moduleId' => 'mechanics'
    ]) ?>
</div>
