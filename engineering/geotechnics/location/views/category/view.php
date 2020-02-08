<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'ژئوتکنیک',
    ['label' => 'مراحل', 'url' => ['/engineering/geotechnics/stage/manage/index']],
    ['label' => 'لیست رده ها', 'url' => ['/engineering/geotechnics/location/category/index']],
    $this->title
];

?>

<div class="category-view">
    <?= $this->render('@nad/common/modules/engineering/location/views/category/view', [
        'model' => $model,
        'moduleId' => 'geotechnics'
    ]) ?>
</div>
