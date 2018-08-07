<?php

use themes\admin360\widgets\ActionButtons;

$this->title = 'تامین کننده جدید';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-create">
    <?= ActionButtons::widget([
        'buttons' => [
            'index' => ['label' => 'لیست تامین کنندگان'],
        ],
    ]); ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
