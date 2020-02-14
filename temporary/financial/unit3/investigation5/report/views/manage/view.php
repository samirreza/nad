<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'موقت',
    'مالی',
    ['label' => 'واحد 3', 'url' => ['/temporary/financial/unit3/manage/index']],
    ['label' => 'فعالیت ه', 'url' => ['/temporary/financial/unit3/manage/investigation5']],
    ['label' => 'لیست گزارش', 'url' => ['index']],
    $this->title
];

?>

<div class="report-view">
    <?= $this->render('@nad/common/modules/investigation/report/views/report/view', [
        'model' => $model,
        'moduleId' => 'unit3'
    ]) ?>
</div>
