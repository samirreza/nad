<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'بررسی، پایش و طراحی',
    ['label' => 'مکانیک', 'url' => ['/engineering/mechanics/manage/index']],
    ['label' => 'بررسی', 'url' => ['/engineering/mechanics/manage/investigation']],
    ['label' => 'لیست منشا', 'url' => ['index']],
    $this->title
];

?>

<div class="source-view">
    <?= $this->render('@nad/common/modules/investigation/source/views/source/view', [
        'model' => $model,
        'moduleId' => 'mechanics',
        'creatProposalRoute' => '/mechanics/investigation/proposal/manage/create'
    ]) ?>
</div>
