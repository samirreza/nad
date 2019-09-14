<?php

use theme\widgets\ActionButtons;

$this->title = 'نوع تجهیز جدید';
$this->params['breadcrumbs'][] = 'تجهیزات';
$this->params['breadcrumbs'][] = ['label' => 'انواع', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="equipment-type-create">
    <?= ActionButtons::widget([
        'buttons' => [
            'index' => ['label' => 'انواع تجهیزات']
        ]
    ]) ?>
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
