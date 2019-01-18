<?php

use theme\widgets\ActionButtons;

$this->title = 'ویرایش گزارش';
$this->params['breadcrumbs'] = [
    'پژوهش',
    'بررسی',
    ['label' => 'گزارش‌ها', 'url' => ['index']],
    [
        'label' => $model->title,
        'url' => ['view', 'id' => $model->id]
    ],
    $this->title
];

?>

<div class="project-update">
	<?= ActionButtons::widget([
        'modelID' => $model->id,
        'buttons' => [
            'index' => ['label' => 'گزارش‌ها']
        ]
    ]) ?>
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
