<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'احداث',
    'چاه',
    ['label' => 'واحد 2', 'url' => ['/build/well/unit2/manage/index']],
    ['label' => 'فعالیت ه', 'url' => ['/build/well/unit2/manage/investigation5']],
    'برنامه منشا',
    ['label' => 'لیست منشاهای برنامه', 'url' => ['index']],
    $this->title
];

?>

<div class="source-view">
    <?= $this->render('@nad/common/modules/investigation/source/views/source/view', [
        'model' => $model,
        'moduleId' => 'unit2',
        'creatProposalRoute' => '/unit2/investigation5/proposal/manage/create'
    ]) ?>
</div>
