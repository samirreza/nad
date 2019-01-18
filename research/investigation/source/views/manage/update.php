<?php

use theme\widgets\ActionButtons;

$this->title = 'ویرایش منشا';
$this->params['breadcrumbs'] = [
    'پژوهش',
    'بررسی',
    ['label' => 'منشاها', 'url' => ['index']],
    [
        'label' => $model->title,
        'url' => ['view', 'id' => $model->id]
    ],
    $this->title
];

?>

<div class="source-update">
	<?= ActionButtons::widget([
        'modelID' => $model->id,
        'buttons' => [
            'index' => ['label' => 'منشاها']
        ]
    ]) ?>
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
