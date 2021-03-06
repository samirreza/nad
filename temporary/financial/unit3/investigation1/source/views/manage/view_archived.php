<?php

$this->title = 'مدرک ' . $model->title;
$this->params['breadcrumbs'] = [
    'موقت',
    'مالی',
    ['label' => 'واحد 3', 'url' => ['/temporary/financial/unit3/manage/index']],
    ['label' => 'فعالیت الف', 'url' => ['/temporary/financial/unit3/manage/investigation1']],
    'داده گاه منشا',
    ['label' => 'لیست داده گاه منشا', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه منشا',
        'url' => ['/temporary/financial/unit3/investigation1/source/manage/index']
    ],
    [
        'label' => 'داده گاه منشا',
        'url' => ['/temporary/financial/unit3/investigation1/source/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند منشا',
        'url' => ['/temporary/financial/unit3/investigation1/source/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/temporary/financial/unit3/investigation1/reference/manage/index']
    ]
];

?>

<div class="source-view">
    <?= $this->render('@nad/common/modules/investigation/source/views/source/view_archived', [
        'model' => $model,
        'moduleId' => 'unit3'
    ]) ?>
</div>
