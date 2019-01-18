<?php

use theme\widgets\ActionButtons;

$this->title = 'گزارش جدید';
$this->params['breadcrumbs'] = [
    'پژوهش',
    'بررسی',
    ['label' => 'گزارش ها', 'url' => ['index']],
    $this->title
];

?>

<div class="project-create">
    <?= ActionButtons::widget([
        'buttons' => [
            'index' => ['label' => 'گزارش ها']
        ]
    ]) ?>
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
