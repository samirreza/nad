<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'میکروبیولوژی', 'url' => ['/process/ird/microbial/manage/index']],
    ['label' => 'بررسی فرایندی', 'url' => ['/process/ird/microbial/manage/investigation']],
    'برنامه منشا',
    ['label' => 'لیست منشاهای برنامه', 'url' => ['index']],
    $this->title
];

?>

<div class="source-view">
    <?= $this->render('@nad/common/modules/investigation/source/views/source/view', [
        'model' => $model,
        'moduleId' => 'microbial',
        'creatProposalRoute' => '/microbial/investigation/proposal/manage/create'
    ]) ?>
</div>
