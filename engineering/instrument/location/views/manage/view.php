<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'ابزار دقیق',
    ['label' => 'مراحل', 'url' => ['/engineering/instrument/stage/manage/index']],
    ['label' => 'لیست گروه های مدارک', 'url' => ['/engineering/instrument/location/manage/index']],
    $this->title
];

?>

<div class="location-view">
    <?= $this->render('@nad/common/modules/engineering/location/views/manage/view', [
        'model' => $model,
        'moduleId' => 'instrument'
    ]) ?>
</div>
