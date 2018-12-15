<?php

use theme\widgets\ActionButtons;

$this->title = 'پروپوزال جدید';
$this->params['breadcrumbs'][] = ['label' => 'پروپوزال ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="proposal-create">
    <?= ActionButtons::widget([
        'buttons' => [
            'index' => ['label' => 'پروپوزال ها']
        ]
    ]) ?>
    <?= $this->render('_form', [
        'model' => $model
    ]) ?>
</div>
