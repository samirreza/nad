<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'بررسی، پایش و طراحی',
    ['label' => 'کنترل', 'url' => ['/engineering/control/manage/index']],
    ['label' => 'بررسی', 'url' => ['/engineering/control/manage/investigation']],
    ['label' => 'لیست گزارش', 'url' => ['index']],
    $this->title
];

?>

<div class="report-view">
    <?= $this->render('@nad/common/modules/investigation/report/views/report/view', [
        'model' => $model,
        'moduleId' => 'control'
    ]) ?>
</div>
