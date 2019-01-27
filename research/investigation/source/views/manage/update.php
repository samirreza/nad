<?php

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
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
