<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'ابزار دقیق',
    ['label' => 'مراحل', 'url' => ['/engineering/instrument/stage/manage/index']],
    ['label' => 'لیست رده ها', 'url' => ['/engineering/instrument/location/category/index']],
    $this->title
];

?>

<div class="category-view">
    <?= $this->render('@nad/common/modules/engineering/location/views/category/view', [
        'model' => $model,
        'moduleId' => 'instrument'
    ]) ?>
</div>
