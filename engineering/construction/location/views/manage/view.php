<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'ساختمان',
    ['label' => 'مراحل', 'url' => ['/engineering/construction/stage/manage/index']],
    ['label' => 'لیست گروه های مدارک', 'url' => ['/engineering/construction/location/manage/index']],
    $this->title
];

?>

<div class="location-view">
    <?= $this->render('@nad/common/modules/engineering/location/views/manage/view', [
        'model' => $model,
        'moduleId' => 'construction'
    ]) ?>
</div>
