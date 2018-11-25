<?php

use theme\widgets\ActionButtons;

$this->title = 'گزارش جدید';
$this->params['breadcrumbs'][] = ['label' => 'لیست گزارش ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="project-create">
    <?= ActionButtons::widget([
        'buttons' => [
            'index' => ['label' => 'لیست گزارش ها']
        ]
    ]) ?>
    <?= $this->render('_form', [
        'model' => $model
    ]) ?>
</div>
