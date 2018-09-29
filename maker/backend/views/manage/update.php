<?php

use themes\admin360\widgets\ActionButtons;

$this->title = 'ویرایش سازنده';
$this->params['breadcrumbs'][] = ['label' => 'لیست سازندگان', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'ویرایش';

?>
<div class="maker-update">
    <?= ActionButtons::widget([
        'modelID' => $model->id,
        'buttons' => [
            'index' => [
                'label' => 'لیست سازندگان',
                'visibleFor' => ['maker.create']
            ]
        ],
    ]); ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>