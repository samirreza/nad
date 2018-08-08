<?php

use themes\admin360\widgets\ActionButtons;

$this->title = 'ویرایش تامین کننده';
$this->params['breadcrumbs'][] = ['label' => 'لیست تامین کنندگان', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $supplier->name, 'url' => ['/supplier/manage/view','id' => $supplier->id]];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'ویرایش';

?>

<div class="phonebook-update">
    <?= ActionButtons::widget([
        'modelID' => $model->id,
        'buttons' => [
            'phonebook' => [
                'label' => 'دفترچه تلفن',
                'url' => ['/supplier/phonebook/manage/list', 'supplierId' => $supplierId],
                'icon' => 'phone',
                'type' => 'info',
            ],
        ],
    ]); ?>
    <?= $this->render('_form', [
        'model' => $model,
        'supplierId' => $supplierId,
    ]) ?>
</div>