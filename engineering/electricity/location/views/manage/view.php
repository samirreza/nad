<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی', 
    'لوله کشی',
    ['label' => 'لیست مکانها', 'url' => ['/piping/location/manage/index']],        
    $this->title
];

?>

<div class="location-view">
    <?= $this->render('@nad/common/modules/engineering/location/views/manage/view', [
        'model' => $model,
        'moduleId' => 'piping'        
    ]) ?>
</div>
