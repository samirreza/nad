<?php

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
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
