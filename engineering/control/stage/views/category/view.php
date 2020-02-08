<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'کنترل',
    ['label' => 'لیست مراحل', 'url' => ['/engineering/control/stage/category/index']],
    $this->title
];

?>

<div class="category-view">
    <?= $this->render('@nad/common/modules/engineering/stage/views/category/view', [
        'model' => $model,
        'moduleId' => 'control'
    ]) ?>
</div>
