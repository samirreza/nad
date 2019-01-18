<?php

$this->title = 'شناسنامه ' . $proposal->title;
$this->params['breadcrumbs'] = [
    'پژوهش',
    'بررسی',
    ['label' => 'پروپوزال‌ها', 'url' => ['index']],
    [
        'label' => $proposal->title,
        'url' => ['view', 'id' => $proposal->id]
    ],
    'شناسنامه'
];

?>

<?= $this->render('@nad/research/investigation/common/views/_base_certificate', [
    'source' => $source,
    'proposal' => $proposal,
    'project' => $project
]) ?>
