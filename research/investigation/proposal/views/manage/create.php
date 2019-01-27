<?php

$this->title = 'پروپوزال جدید';
$this->params['breadcrumbs'] = [
    'پژوهش',
    'بررسی',
    ['label' => 'پروپوزال‌ها', 'url' => ['index']],
    $this->title
];

?>

<div class="proposal-create">
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
