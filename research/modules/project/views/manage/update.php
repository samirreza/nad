<?php

use theme\widgets\ActionButtons;

$this->title = 'ویرایش گزارش';
$this->params['breadcrumbs'][] = ['label' => 'لیست گزارش ها', 'url' => ['index']];
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
            'create' => ['label' => 'درج گزارش'],
            'delete' => ['label' => 'حذف گزارش'],
            'index' => ['label' => 'لیست گزارش ها']
        ]
    ]) ?>
    <?= $this->render('_form', [
        'model' => $model
    ]) ?>
</div>
