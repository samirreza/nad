<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی', 
    'ابزار دقیق',
    ['label' => 'لیست مراحل', 'url' => ['/instrument/stage/manage/index']],        
    $this->title
];

?>

<div class="stage-view">
    <?= $this->render('@nad/common/modules/engineering/stage/views/manage/view', [
        'model' => $model,
        'moduleId' => 'stage'        
    ]) ?>
</div>
