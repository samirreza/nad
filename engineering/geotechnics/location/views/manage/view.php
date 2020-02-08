<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'ژئوتکنیک',
    ['label' => 'مراحل', 'url' => ['/engineering/geotechnics/stage/manage/index']],
    ['label' => 'لیست گروه های مدارک', 'url' => ['/engineering/geotechnics/location/manage/index']],
    $this->title
];

?>

<div class="location-view">
    <?= $this->render('@nad/common/modules/engineering/location/views/manage/view', [
        'model' => $model,
        'moduleId' => 'geotechnics'
    ]) ?>
</div>
