<?php

$this->title = 'مدرک ' . $model->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'آر او', 'url' => ['/ro/manage/index']],
    ['label' => 'بررسی پایش', 'url' => ['/ro/manage/investigation-monitor']],
    'داده گاه منشا',
    ['label' => 'لیست داده گاه منشا', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه منشا',
        'url' => ['/ro/investigationMonitor/source/manage/index']
    ],
    [
        'label' => 'داده گاه منشا',
        'url' => ['/ro/investigationMonitor/source/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند منشا',
        'url' => ['/ro/investigationMonitor/source/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/ro/investigationMonitor/reference/manage/index']
    ]
];

?>

<div class="source-view">
    <?= $this->render('@nad/common/modules/investigation/source/views/source/view_archived', [
        'model' => $model,
        'moduleId' => 'ro'
    ]) ?>
</div>
