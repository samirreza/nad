<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'بندر',
    'واحد بندر',
    ['label' => 'واحد 2', 'url' => ['/seaport/wayside/unit2/manage/index']],
    ['label' => 'فعالیت ج', 'url' => ['/seaport/wayside/unit2/manage/investigation3']],
    'داده گاه روندهای گزارش',
    ['label' => 'لیست داده گاه روندهای گزارش', 'url' => ['index-history']],
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه گزارش',
        'url' => ['/seaport/wayside/unit2/investigation3/report/manage/index']
    ],
    [
        'label' => 'داده گاه گزارش',
        'url' => ['/seaport/wayside/unit2/investigation3/report/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند گزارش',
        'url' => ['/seaport/wayside/unit2/investigation3/report/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/seaport/wayside/unit2/investigation3/reference/manage/index']
    ]
];

?>

<div class="report-view">
    <?= $this->render('@nad/common/modules/investigation/report/views/report/view_history', [
        'model' => $model,
        'logs' => $logs,
        'logCounter' => $logCounter,
        'allComments' =>$allComments,
        'moduleId' => 'unit2'
    ]) ?>
</div>
