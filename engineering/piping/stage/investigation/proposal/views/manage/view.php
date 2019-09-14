<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'بررسی، پایش و طراحی',
    'لوله کشی',
    ['label' => 'مراحل', 'url' => ['/engineering/piping/stage']], 
    ['label' => 'بررسی', 'url' => ['/engineering/piping/stage/manage/investigation']],
    ['label' => 'لیست پروپوزال', 'url' => ['index']],
    $this->title
];

?>

<div class="proposal-view">
    <?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/view', [
        'model' => $model,
        'moduleId' => 'piping',
        'creatReportRoute' => '/piping/investigation/report/manage/create'
    ]) ?>
</div>
