<?php

$this->title = 'منشا جدید';
$this->params['breadcrumbs'] = [
    'پژوهش',
    'بررسی',
    ['label' => 'منشاها', 'url' => ['index']],
    $this->title
];

?>

<div class="source-create">
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
