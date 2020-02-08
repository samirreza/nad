<?php

$this->title = 'مدرک ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'کنترل',
    ['label' => 'مراحل', 'url' => ['/engineering/control/stage/manage/index']],
    ['label' => 'بررسی روشهای پایش', 'url' => ['/engineering/control/stage/manage/investigation-monitor-methods']],
    'داده گاه دستورالعمل',
    ['label' => 'لیست داده گاه دستورالعمل', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه دستورالعمل',
        'url' => ['/engineering/control/stage/investigationMonitorMethods/instruction/manage/index']
    ],
    [
        'label' => 'داده گاه دستورالعمل',
        'url' => ['/engineering/control/stage/investigationMonitorMethods/instruction/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند دستورالعمل',
        'url' => ['/engineering/control/stage/investigationMonitorMethods/instruction/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/engineering/control/stage/investigationMonitorMethods/reference/manage/index']
    ]
];

?>

<div class="instruction-view">
    <?= $this->render('@nad/common/modules/investigation/instruction/views/instruction/view_archived', [
        'model' => $model,
        'moduleId' => 'stage'
    ]) ?>
</div>
