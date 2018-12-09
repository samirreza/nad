<?php

use theme\widgets\ActionButtons;

$this->title = 'منشا جدید';
$this->params['breadcrumbs'][] = ['label' => 'لیست منشاها', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="source-create">
    <?= ActionButtons::widget([
        'buttons' => [
            'index' => ['label' => 'لیست منشاها']
        ]
    ]) ?>
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
