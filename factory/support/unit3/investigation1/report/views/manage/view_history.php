<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'کارخانه',
    'پشتیبانی',
    ['label' => 'واحد 3', 'url' => ['/factory/support/unit3/manage/index']],
    ['label' => 'فعالیت الف', 'url' => ['/factory/support/unit3/manage/investigation1']],
    'داده گاه روندهای گزارش',
    ['label' => 'لیست داده گاه روندهای گزارش', 'url' => ['index-history']],
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه گزارش',
        'url' => ['/factory/support/unit3/investigation1/report/manage/index']
    ],
    [
        'label' => 'داده گاه گزارش',
        'url' => ['/factory/support/unit3/investigation1/report/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند گزارش',
        'url' => ['/factory/support/unit3/investigation1/report/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/factory/support/unit3/investigation1/reference/manage/index']
    ]
];

?>

<div class="report-view">
    <?= $this->render('@nad/common/modules/investigation/report/views/report/view_history', [
        'model' => $model,
        'logs' => $logs,
        'logCounter' => $logCounter,
        'allComments' =>$allComments,
        'moduleId' => 'unit3'
    ]) ?>
</div>
