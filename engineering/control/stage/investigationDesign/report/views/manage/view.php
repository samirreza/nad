<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'کنترل',
    ['label' => 'مراحل', 'url' => ['/engineering/control/stage/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/engineering/control/stage/manage/investigation-design']],
    ['label' => 'لیست گزارش', 'url' => ['index']],
    $this->title
];

?>

<div class="report-view">
    <?= $this->render('@nad/common/modules/investigation/report/views/report/view', [
        'model' => $model,
        'moduleId' => 'stage'
    ]) ?>
</div>
