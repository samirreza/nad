<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'بندر',
    'واحد بندر',
    ['label' => 'واحد 3', 'url' => ['/seaport/wayside/unit3/manage/index']],
    ['label' => 'فعالیت ب', 'url' => ['/seaport/wayside/unit3/manage/investigation2']],
    'داده گاه روندهای منشا',
    ['label' => 'لیست داده گاه روندهای منشا', 'url' => ['index-history']],
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه منشا',
        'url' => ['/seaport/wayside/unit3/investigation2/source/manage/index']
    ],
    [
        'label' => 'داده گاه منشا',
        'url' => ['/seaport/wayside/unit3/investigation2/source/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند منشا',
        'url' => ['/seaport/wayside/unit3/investigation2/source/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/seaport/wayside/unit3/investigation2/reference/manage/index']
    ]
];

?>

<div class="source-view">
    <?= $this->render('@nad/common/modules/investigation/source/views/source/view_history', [
        'model' => $model,
        'logs' => $logs,
        'logCounter' => $logCounter,
        'allComments' =>$allComments,
        'moduleId' => 'unit3'
    ]) ?>
</div>
