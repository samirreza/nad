<?php

$this->title = 'مدرک ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'مکانیک',
    ['label' => 'مراحل', 'url' => ['/engineering/mechanics/stage/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/mechanics/stage/manage/investigation-improvement']],
    'داده گاه گزارش',
    ['label' => 'لیست داده گاه گزارش', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه گزارش',
        'url' => ['/engineering/mechanics/stage/investigationImprovement/report/manage/index']
    ],
    [
        'label' => 'داده گاه گزارش',
        'url' => ['/engineering/mechanics/stage/investigationImprovement/report/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند گزارش',
        'url' => ['/engineering/mechanics/stage/investigationImprovement/report/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/engineering/mechanics/stage/investigationImprovement/reference/manage/index']
    ]
];

?>

<div class="report-view">
    <?= $this->render('@nad/common/modules/investigation/report/views/report/view_archived', [
        'model' => $model,
        'moduleId' => 'stage'
    ]) ?>
</div>
