<?php

$this->title = 'مدیریت مراجع پروژه';
$this->params['breadcrumbs'][] = ['label' => 'لیست پروژه ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = [
    'label' => $model->title,
    'url' => ['view', 'id' => $model->id]
];
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('@nad/extensions/documentation/views/index', [
    'documentation' => $documentation,
    'modelId' => $model->id
]);
