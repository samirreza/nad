<?php

$this->title = 'شناسنامه مدرک ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'ژئوتکنیک',
    ['label' => 'مراحل', 'url' => ['/engineering/geotechnics/stage/manage/index']],
    ['label' => 'لیست مراحل', 'url' => ['/engineering/geotechnics/stage/category']],
    ['label' => 'گروه مدارک', 'url' => ['/engineering/geotechnics/location/manage/index'],
    ['label' => 'لیست مدارک', 'url' => ['/engineering/geotechnics/document/manage/index', 'groupId' => $model->groupId]]],
    $this->title
];

?>

<div class="document-view">
    <?= $this->render('@nad/common/modules/engineering/document/views/manage/view', [
        'model' => $model,
        'moduleId' => 'geotechnics'
    ]) ?>
</div>
