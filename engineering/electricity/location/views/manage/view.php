<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'برق',
    ['label' => 'مراحل', 'url' => ['/engineering/electricity/stage/manage/index']],
    ['label' => 'لیست گروه های مدارک', 'url' => ['/engineering/electricity/location/manage/index']],
    $this->title
];

?>

<div class="location-view">
    <?= $this->render('@nad/common/modules/engineering/location/views/manage/view', [
        'model' => $model,
        'moduleId' => 'electricity'
    ]) ?>
</div>
