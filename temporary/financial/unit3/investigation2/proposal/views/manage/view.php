<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'موقت',
    'مالی',
    ['label' => 'واحد 3', 'url' => ['/temporary/financial/unit3/manage/index']],
    ['label' => 'فعالیت ب', 'url' => ['/temporary/financial/unit3/manage/investigation2']],
    ['label' => 'لیست پروپوزال', 'url' => ['index']],
    $this->title
];

?>

<div class="proposal-view">
    <?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/view', [
        'model' => $model,
        'moduleId' => 'unit3',
        'creatReportRoute' => '/unit3/investigation2/report/manage/create'
    ]) ?>
</div>
