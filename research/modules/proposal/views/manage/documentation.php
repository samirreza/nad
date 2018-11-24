<?php

$this->title = 'مدیریت مراجع پروپوزال';
$this->params['breadcrumbs'][] = ['label' => 'لیست پروپوزال ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = [
    'label' => $model->title,
    'url' => ['view', 'id' => $model->id]
];
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('@nad/extensions/documentation/views/index', [
    'documentation' => $documentation,
    'modelId' => $model->id
]);
