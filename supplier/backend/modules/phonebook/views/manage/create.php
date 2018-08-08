<?php

use themes\admin360\widgets\ActionButtons;

$this->title = 'شماره تماس جدید';
$this->params['breadcrumbs'][] = [
    'label' => 'لیست تامین کنندگان',
    'url' => ['/supplier/manage/index']
];
$this->params['breadcrumbs'][] = [
    'label' => $supplier->name,
    'url' => ['/supplier/manage/view', 'id' => $supplier->id]
];
$this->params['breadcrumbs'][] = [
    'label' => 'لیست شماره تماس ها',
    'url' => ['/supplier/phonebook/manage/list', 'supplierId' => $supplierId]
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phonebook-create">
    <?= ActionButtons::widget([
        'buttons' => [
            'phonebook' => [
                'label' => 'دفترچه تلفن',
                'url' => ['list', 'supplierId' => $supplierId],
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
