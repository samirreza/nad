<?php

use theme\widgets\ActionButtons;

$this->title = 'پروپوزال جدید';
$this->params['breadcrumbs'] = [
    'پژوهش',
    'بررسی',
    ['label' => 'پروپوزال‌ها', 'url' => ['index']],
    $this->title
];

?>

<div class="proposal-create">
    <?= ActionButtons::widget([
        'buttons' => [
            'index' => ['label' => 'پروپوزال‌ها']
        ]
    ]) ?>
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
