<?php

use theme\widgets\ActionButtons;

$this->title = 'ویرایش منشا';
$this->params['breadcrumbs'][] = ['label' => 'لیست منشاها', 'url' => ['index']];
$this->params['breadcrumbs'][] = [
    'label' => $model->title,
    'url' => ['view', 'id' => $model->id]
];
$this->params['breadcrumbs'][] = 'ویرایش';

?>

<div class="source-update">
	<?= ActionButtons::widget([
        'modelID' => $model->id,
        'buttons' => [
            'index' => ['label' => 'لیست منشاها']
        ]
    ]) ?>
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
