<?php

use theme\widgets\ActionButtons;

$this->title = 'منشا جدید';
$this->params['breadcrumbs'] = [
    'پژوهش',
    'بررسی',
    ['label' => 'منشاها', 'url' => ['index']],
    $this->title
];

?>

<div class="source-create">
    <?= ActionButtons::widget([
        'buttons' => [
            'index' => ['label' => 'منشاها']
        ]
    ]) ?>
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
