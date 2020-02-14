<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'کارخانه',
    'تولید',
    ['label' => 'واحد 2', 'url' => ['/factory/production/unit2/manage/index']],
    ['label' => 'فعالیت ج', 'url' => ['/factory/production/unit2/manage/investigation3']],
    ['label' => 'لیست دستورالعمل', 'url' => ['index']],
    $this->title
];

?>

<div class="instruction-view">
    <?= $this->render('@nad/common/modules/investigation/instruction/views/instruction/view', [
        'model' => $model,
        'moduleId' => 'unit2'
    ]) ?>
</div>
