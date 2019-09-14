<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی', 
    'لوله کشی',
    ['label' => 'مراحل', 'url' => ['/engineering/piping/stage/manage/index']], 
    ['label' => 'لیست رده ها', 'url' => ['/engineering/piping/location/category/index']],        
    $this->title
];

?>

<div class="category-view">
    <?= $this->render('@nad/common/modules/engineering/location/views/category/view', [
        'model' => $model,
        'moduleId' => 'piping'        
    ]) ?>
</div>
