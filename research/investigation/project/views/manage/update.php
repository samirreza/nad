<?php

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
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
