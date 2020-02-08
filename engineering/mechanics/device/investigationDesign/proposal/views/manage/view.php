<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'مکانیک',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/mechanics/device/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/engineering/mechanics/device/manage/investigation-design']],
    ['label' => 'لیست پروپوزال', 'url' => ['index']],
    $this->title
];

?>

<div class="proposal-view">
    <?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/view', [
        'model' => $model,
        'moduleId' => 'device',
        'creatReportRoute' => '/device/investigationDesign/report/manage/create'
    ]) ?>
</div>
