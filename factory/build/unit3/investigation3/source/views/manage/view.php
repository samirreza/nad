<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'کارخانه',
    'احداث',
    ['label' => 'واحد 3', 'url' => ['/factory/build/unit3/manage/index']],
    ['label' => 'فعالیت ج', 'url' => ['/factory/build/unit3/manage/investigation3']],
    'برنامه منشا',
    ['label' => 'لیست منشاهای برنامه', 'url' => ['index']],
    $this->title
];

?>

<div class="source-view">
    <?= $this->render('@nad/common/modules/investigation/source/views/source/view', [
        'model' => $model,
        'moduleId' => 'unit3',
        'creatProposalRoute' => '/unit3/investigation3/proposal/manage/create'
    ]) ?>
</div>
