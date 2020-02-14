<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'کارخانه',
    'تولید',
    ['label' => 'واحد 2', 'url' => ['/factory/production/unit2/manage/index']],
    ['label' => 'فعالیت ج', 'url' => ['/factory/production/unit2/manage/investigation3']],
    'برنامه منشا',
    ['label' => 'لیست منشاهای برنامه', 'url' => ['index']],
    $this->title
];

?>

<div class="source-view">
    <?= $this->render('@nad/common/modules/investigation/source/views/source/view', [
        'model' => $model,
        'moduleId' => 'unit2',
        'creatProposalRoute' => '/unit2/investigation3/proposal/manage/create'
    ]) ?>
</div>
