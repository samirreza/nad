<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'ژئوتکنیک',
    ['label' => 'لیست مراحل', 'url' => ['/engineering/geotechnics/stage/category/index']],
    $this->title
];

?>

<div class="category-view">
    <?= $this->render('@nad/common/modules/engineering/stage/views/category/view', [
        'model' => $model,
        'moduleId' => 'geotechnics'
    ]) ?>
</div>
