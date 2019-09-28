<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'میکروبی', 'url' => ['/microbial/manage/index']],
    ['label' => 'بررسی', 'url' => ['/microbial/manage/investigation']],
    ['label' => 'لیست پروپوزال', 'url' => ['index']],
    $this->title
];

?>

<div class="proposal-view">
    <?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/view', [
        'model' => $model,
        'moduleId' => 'microbial',
        'creatReportRoute' => '/microbial/investigation/report/manage/create'
    ]) ?>
</div>
