<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'برق',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/electricity/device/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/engineering/electricity/device/manage/investigation-design']],
    'داده گاه روندهای روش',
    ['label' => 'لیست داده گاه روندهای روش', 'url' => ['index-history']],
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه روش',
        'url' => ['/engineering/electricity/device/investigationDesign/method/manage/index']
    ],
    [
        'label' => 'داده گاه روش',
        'url' => ['/engineering/electricity/device/investigationDesign/method/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند روش',
        'url' => ['/engineering/electricity/device/investigationDesign/method/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/engineering/electricity/device/investigationDesign/reference/manage/index']
    ]
];

?>

<div class="method-view">
    <?= $this->render('@nad/common/modules/investigation/method/views/method/view_history', [
        'model' => $model,
        'logs' => $logs,
        'logCounter' => $logCounter,
        'allComments' =>$allComments,
        'moduleId' => 'device'
    ]) ?>
</div>
