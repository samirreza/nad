<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'ساختمان',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/construction/device/manage/index']],
    ['label' => 'بررسی روشهای پایش', 'url' => ['/engineering/construction/device/manage/investigation-monitor-methods']],
    ['label' => 'لیست پروپوزال', 'url' => ['index']],
    $this->title
];

?>

<div class="proposal-view">
    <?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/view', [
        'model' => $model,
        'moduleId' => 'device',
        'creatReportRoute' => '/device/investigationMonitorMethods/report/manage/create'
    ]) ?>
</div>
