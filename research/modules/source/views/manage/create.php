<?php

use theme\widgets\ActionButtons;

$this->title = 'منشا جدید';
$this->params['breadcrumbs'][] = ['label' => 'منشاها', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="source-create">
    <?= ActionButtons::widget([
        'buttons' => [
            'index' => ['label' => 'منشاها']
        ]
    ]) ?>
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
