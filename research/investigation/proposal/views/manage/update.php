<?php

use theme\widgets\ActionButtons;

$this->title = 'ویرایش پروپوزال';
$this->params['breadcrumbs'] = [
    'پژوهش',
    'بررسی',
    ['label' => 'پروپوزال‌ها', 'url' => ['index']],
    [
        'label' => $model->title,
        'url' => ['view', 'id' => $model->id]
    ],
    $this->title
];

?>

<div class="proposal-update">
	<?= ActionButtons::widget([
        'modelID' => $model->id,
        'buttons' => [
            'index' => ['label' => 'پروپوزال‌ها']
        ]
    ]) ?>
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
