<?php

$this->title = 'مدرک ' . $model->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'پساب', 'url' => ['/wastewater/manage/index']],
    ['label' => 'بررسی پایش', 'url' => ['/wastewater/manage/investigation-monitor']],
    'داده گاه گزارش',
    ['label' => 'لیست داده گاه گزارش', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه گزارش',
        'url' => ['/wastewater/investigationMonitor/report/manage/index']
    ],
    [
        'label' => 'داده گاه گزارش',
        'url' => ['/wastewater/investigationMonitor/report/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند گزارش',
        'url' => ['/wastewater/investigationMonitor/report/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/wastewater/investigationMonitor/reference/manage/index']
    ]
];

?>

<div class="report-view">
    <?= $this->render('@nad/common/modules/investigation/report/views/report/view_archived', [
        'model' => $model,
        'moduleId' => 'wastewater'
    ]) ?>
</div>
