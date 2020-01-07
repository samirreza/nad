<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'کارتریج', 'url' => ['/cartridge/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/cartridge/manage/investigation-design']],
    'داده گاه روندهای گزارش',
    ['label' => 'لیست داده گاه روندهای گزارش', 'url' => ['index-history']],
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه گزارش',
        'url' => ['/cartridge/investigationDesign/report/manage/index']
    ],
    [
        'label' => 'داده گاه گزارش',
        'url' => ['/cartridge/investigationDesign/report/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند گزارش',
        'url' => ['/cartridge/investigationDesign/report/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/cartridge/investigationDesign/reference/manage/index']
    ]
];

?>

<div class="report-view">
    <?= $this->render('@nad/common/modules/investigation/report/views/report/view_history', [
        'model' => $model,
        'logs' => $logs,
        'logCounter' => $logCounter,
        'allComments' =>$allComments,
        'moduleId' => 'cartridge'
    ]) ?>
</div>