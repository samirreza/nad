<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'جی آر اس', 'url' => ['/process/materials/grs/manage/index']],
    ['label' => 'بررسی', 'url' => ['/process/materials/grs/manage/investigation-monitor']],
    ['label' => 'لیست پروپوزال', 'url' => ['index']],
    $this->title
];

?>

<div class="proposal-view">
    <?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/view', [
        'model' => $model,
        'moduleId' => 'grs',
        'creatReportRoute' => '/grs/investigationMonitor/report/manage/create'
    ]) ?>
</div>
