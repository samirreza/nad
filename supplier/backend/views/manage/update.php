<?php

use themes\admin360\widgets\ActionButtons;

$this->title = 'ویرایش تامین کننده';
$this->params['breadcrumbs'][] = ['label' => 'لیست تامین کنندگان', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'ویرایش';

?>
<div class="supplier-update">
    <?= ActionButtons::widget([
        'modelID' => $model->id,
        'buttons' => [
            'delete' => ['label' => 'حذف'],
            'index' => ['label' => 'لیست تامین کنندگان'],
        ],
    ]); ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
