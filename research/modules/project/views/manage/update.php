<?php

use theme\widgets\ActionButtons;

$this->title = 'ویرایش پروژه';
$this->params['breadcrumbs'][] = ['label' => 'لیست پروژه ها', 'url' => ['index']];
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
            'create' => ['label' => 'درج پروژه'],
            'delete' => ['label' => 'حذف پروژه'],
            'index' => ['label' => 'لیست پروژه ها']
        ]
    ]) ?>
    <?= $this->render('_form', [
        'model' => $model
    ]) ?>
</div>
