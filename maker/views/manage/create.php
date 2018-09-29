<?php

use theme\widgets\ActionButtons;

$this->title = 'سازنده جدید';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maker-create">
    <?= ActionButtons::widget([
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
