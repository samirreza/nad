<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'ژئوتکنیک',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/geotechnics/device/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/geotechnics/device/manage/investigation-improvement']],
    ['label' => 'لیست پروپوزال', 'url' => ['index']],
    $this->title
];

?>

<div class="proposal-view">
    <?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/view', [
        'model' => $model,
        'moduleId' => 'device',
        'creatReportRoute' => '/device/investigationImprovement/report/manage/create'
    ]) ?>
</div>
