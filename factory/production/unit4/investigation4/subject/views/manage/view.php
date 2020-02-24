<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'کارخانه',
    'تولید',
    ['label' => 'تعمیرات و نگهداری', 'url' => ['/factory/production/unit4/manage/index']],
    ['label' => 'فعالیت د', 'url' => ['/factory/production/unit4/manage/investigation4']],
    ['label' => 'لیست موضوع های فعال', 'url' => ['index']],
    $this->title
];

?>

<div class="subject-view">
    <?= $this->render('@nad/common/modules/investigation/subject/views/subject/view', [
        'model' => $model,
        'logs' => $logs,
        'logCounter' => $logCounter,
        'allComments' =>$allComments,
        'moduleId' => 'unit4'
    ]) ?>
</div>
