<?php

use theme\widgets\ActionButtons;

$this->title = 'ویرایش گزارش';
$this->params['breadcrumbs'][] = ['label' => 'گزارش ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = [
    'label' => $model->title,
    'url' => ['view', 'id' => $model->id]
];
$this->params['breadcrumbs'][] = 'ویرایش';

?>

<div class="project-update">
	<?= ActionButtons::widget([
        'modelID' => $model->id,
        'buttons' => [
            'index' => ['label' => 'گزارش ها']
        ]
    ]) ?>
    <?= $this->render('_form', ['model' => $model]) ?>
</div>