<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'مکانیک',
    ['label' => 'مراحل', 'url' => ['/engineering/mechanics/stage/manage/index']],
    ['label' => 'لیست گروه های مدارک', 'url' => ['/engineering/mechanics/location/manage/index']],
    $this->title
];

?>

<div class="location-view">
    <?= $this->render('@nad/common/modules/engineering/location/views/manage/view', [
        'model' => $model,
        'moduleId' => 'mechanics'
    ]) ?>
</div>
