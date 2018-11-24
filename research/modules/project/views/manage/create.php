<?php

use theme\widgets\ActionButtons;

$this->title = 'پروژه جدید';
$this->params['breadcrumbs'][] = ['label' => 'لیست پروژه ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="project-create">
    <?= ActionButtons::widget([
        'buttons' => [
            'index' => ['label' => 'لیست پروژه ها']
        ]
    ]) ?>
    <?= $this->render('_form', [
        'model' => $model
    ]) ?>
</div>
