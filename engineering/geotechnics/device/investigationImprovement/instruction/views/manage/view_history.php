<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'ژئوتکنیک',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/geotechnics/device/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/geotechnics/device/manage/investigation-improvement']],
    'داده گاه روندهای دستورالعمل',
    ['label' => 'لیست داده گاه روندهای دستورالعمل', 'url' => ['index-history']],
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه دستورالعمل',
        'url' => ['/engineering/geotechnics/device/investigationImprovement/instruction/manage/index']
    ],
    [
        'label' => 'داده گاه دستورالعمل',
        'url' => ['/engineering/geotechnics/device/investigationImprovement/instruction/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند دستورالعمل',
        'url' => ['/engineering/geotechnics/device/investigationImprovement/instruction/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/engineering/geotechnics/device/investigationImprovement/reference/manage/index']
    ]
];

?>

<div class="instruction-view">
    <?= $this->render('@nad/common/modules/investigation/instruction/views/instruction/view_history', [
        'model' => $model,
        'logs' => $logs,
        'logCounter' => $logCounter,
        'allComments' =>$allComments,
        'moduleId' => 'device'
    ]) ?>
</div>
