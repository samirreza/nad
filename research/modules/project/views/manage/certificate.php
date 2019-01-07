<?php

$this->title = 'شناسنامه ' . $source->title;
$this->params['breadcrumbs'] = [
    'پژوهش',
    'بررسی',
    ['label' => 'گزارش‌ها', 'url' => ['index']],
    [
        'label' => $project->title,
        'url' => ['view', 'id' => $project->id]
    ],
    'شناسنامه'
];

?>

<?= $this->render('@nad/research/common/views/base-certificate', [
    'source' => $source,
    'proposal' => $proposal,
    'project' => $project
]) ?>
