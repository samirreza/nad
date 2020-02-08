<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'انتقال حرارت', 'url' => ['/heattransfer/manage/index']],
    ['label' => 'بررسی پایش', 'url' => ['/heattransfer/manage/investigation-monitor']],
    'داده گاه روندهای روش',
    ['label' => 'لیست داده گاه روندهای روش', 'url' => ['index-history']],
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه روش',
        'url' => ['/heattransfer/investigationMonitor/method/manage/index']
    ],
    [
        'label' => 'داده گاه روش',
        'url' => ['/heattransfer/investigationMonitor/method/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند روش',
        'url' => ['/heattransfer/investigationMonitor/method/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/heattransfer/investigationMonitor/reference/manage/index']
    ]
];

?>

<div class="method-view">
    <?= $this->render('@nad/common/modules/investigation/method/views/method/view_history', [
        'model' => $model,
        'logs' => $logs,
        'logCounter' => $logCounter,
        'allComments' =>$allComments,
        'moduleId' => 'heattransfer'
    ]) ?>
</div>
