<?php

$this->title = 'مدرک ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'مکانیک',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/mechanics/device/manage/index']],
    ['label' => 'بررسی روشهای پایش', 'url' => ['/engineering/mechanics/device/manage/investigation-monitor-methods']],
    'داده گاه پروپوزال',
    ['label' => 'لیست داده گاه پروپوزال', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه پروپوزال',
        'url' => ['/engineering/mechanics/device/investigationMonitorMethods/proposal/manage/index']
    ],
    [
        'label' => 'داده گاه پروپوزال',
        'url' => ['/engineering/mechanics/device/investigationMonitorMethods/proposal/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند پروپوزال',
        'url' => ['/engineering/mechanics/device/investigationMonitorMethods/proposal/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/engineering/mechanics/device/investigationMonitorMethods/reference/manage/index']
    ]
];

?>

<div class="proposal-view">
    <?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/view_archived', [
        'model' => $model,
        'moduleId' => 'device'
    ]) ?>
</div>
