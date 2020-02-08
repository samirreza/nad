<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'کنترل',
    ['label' => 'مراحل', 'url' => ['/engineering/control/stage/manage/index']],
    ['label' => 'لیست رده ها', 'url' => ['/engineering/control/location/category/index']],
    $this->title
];

?>

<div class="category-view">
    <?= $this->render('@nad/common/modules/engineering/location/views/category/view', [
        'model' => $model,
        'moduleId' => 'control'
    ]) ?>
</div>
