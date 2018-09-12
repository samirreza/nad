<?php

use themes\admin360\widgets\ActionButtons;

$this->title = 'تعمیرکار جدید';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repairer-create">
    <?= ActionButtons::widget([
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
