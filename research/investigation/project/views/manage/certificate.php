<?php

$this->title = 'شناسنامه ' . $project->title;
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

<?= $this->render('@nad/research/investigation/common/views/_base_certificate', [
    'source' => $source,
    'proposal' => $proposal,
    'project' => $project
]) ?>
