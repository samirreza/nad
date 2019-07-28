<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی', 
    'چاه',
    ['label' => 'لیست مراحل', 'url' => ['/well/stage/manage/index']],        
    $this->title
];

?>

<div class="stage-view">
    <?= $this->render('@nad/common/modules/engineering/stage/views/manage/view', [
        'model' => $model,
        'moduleId' => 'stage'        
    ]) ?>
</div>
