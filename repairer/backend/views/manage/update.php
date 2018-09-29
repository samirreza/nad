<?php

use themes\admin360\widgets\ActionButtons;

$this->title = 'ویرایش تعمیرکار';
$this->params['breadcrumbs'][] = ['label' => 'لیست تعمیرکاران', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'ویرایش';

?>
<div class="repairer-update">
    <?= ActionButtons::widget([
        'modelID' => $model->id,
        'buttons' => [
            'index' => [
                'label' => 'لیست تعمیرکاران',
                'visibleFor' => ['repairer.create']
            ]
        ],
    ]); ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>