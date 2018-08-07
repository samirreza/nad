<?php

use themes\admin360\widgets\ActionButtons;

$this->title = 'شماره تماس جدید';
$this->params['breadcrumbs'][] = [
    'label' => 'لیست شماره تماس ها',
    'url' => ['/supplier/phonebook/list', 'id' => $supplierId]
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
