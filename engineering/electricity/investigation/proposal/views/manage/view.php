<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'بررسی، پایش و طراحی',
    ['label' => 'برق', 'url' => ['/engineering/electricity/manage/index']],
    ['label' => 'بررسی', 'url' => ['/engineering/electricity/manage/investigation']],
    ['label' => 'لیست پروپوزال', 'url' => ['index']],
    $this->title
];

?>

<div class="proposal-view">
    <?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/view', [
        'model' => $model,
        'moduleId' => 'electricity',
        'creatReportRoute' => '/electricity/investigation/report/manage/create'
    ]) ?>
</div>
