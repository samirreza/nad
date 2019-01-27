<?php

$this->title = 'گزارش جدید';
$this->params['breadcrumbs'] = [
    'پژوهش',
    'بررسی',
    ['label' => 'گزارش ها', 'url' => ['index']],
    $this->title
];

?>

<div class="project-create">
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
