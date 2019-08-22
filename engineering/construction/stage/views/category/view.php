<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی', 
    'ساختمان',  
    ['label' => 'لیست رده ها', 'url' => ['/engineering/construction/stage/category/index']],        
    $this->title
];

?>

<div class="category-view">
    <?= $this->render('@nad/common/modules/engineering/stage/views/category/view', [
        'model' => $model,
        'moduleId' => 'piping'        
    ]) ?>
</div>
