<?php

$this->title = 'شناسنامه مدرک ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی', 
    'لوله کشی',
    ['label' => 'مراحل', 'url' => ['/engineering/piping/stage/manage/index']], 
    ['label' => 'لیست مراحل', 'url' => ['/engineering/piping/stage/category']],
    ['label' => 'گروه مدارک', 'url' => ['/engineering/piping/location/manage/index'],
    ['label' => 'لیست مدارک', 'url' => ['/engineering/piping/document/manage/index', 'groupId' => $model->groupId]]],
    $this->title
];

?>

<div class="document-view">
    <?= $this->render('@nad/common/modules/engineering/document/views/manage/view', [
        'model' => $model,
        'moduleId' => 'piping'        
    ]) ?>
</div>
