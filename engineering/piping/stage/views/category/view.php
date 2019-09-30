<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'لیست مراحل', 'url' => ['/engineering/piping/stage/category/index']],
    $this->title
];

?>

<div class="category-view">
    <?= $this->render('@nad/common/modules/engineering/stage/views/category/view', [
        'model' => $model,
        'moduleId' => 'piping'
    ]) ?>
</div>
