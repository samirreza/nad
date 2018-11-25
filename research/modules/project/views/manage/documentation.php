<?php

$this->title = 'مدیریت مراجع گزارش';
$this->params['breadcrumbs'][] = ['label' => 'لیست گزارش ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = [
    'label' => $model->title,
    'url' => ['view', 'id' => $model->id]
];
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('@nad/extensions/documentation/views/index', [
    'documentation' => $documentation,
    'modelId' => $model->id
]);
