<?php

use themes\admin360\widgets\ActionButtons;

$this->title = 'ویرایش سمت';
$this->params['breadcrumbs'][] = ['label' => 'لیست تامین کنندگان', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'لیست سمت ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'ویرایش';

?>

<div class="job-update">
    <?= ActionButtons::widget([
        'modelID' => $model->id,
        'buttons' => [
            //'delete' => ['label' => 'حذف'],
            'index' => ['label' => 'لیست سمت ها'],
        ],
    ]); ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
