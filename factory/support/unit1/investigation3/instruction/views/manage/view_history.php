<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'کارخانه',
    'پشتیبانی',
    ['label' => 'واحد 1', 'url' => ['/factory/support/unit1/manage/index']],
    ['label' => 'فعالیت ج', 'url' => ['/factory/support/unit1/manage/investigation3']],
    'داده گاه روندهای دستورالعمل',
    ['label' => 'لیست داده گاه روندهای دستورالعمل', 'url' => ['index-history']],
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه دستورالعمل',
        'url' => ['/factory/support/unit1/investigation3/instruction/manage/index']
    ],
    [
        'label' => 'داده گاه دستورالعمل',
        'url' => ['/factory/support/unit1/investigation3/instruction/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند دستورالعمل',
        'url' => ['/factory/support/unit1/investigation3/instruction/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/factory/support/unit1/investigation3/reference/manage/index']
    ]
];

?>

<div class="instruction-view">
    <?= $this->render('@nad/common/modules/investigation/instruction/views/instruction/view_history', [
        'model' => $model,
        'logs' => $logs,
        'logCounter' => $logCounter,
        'allComments' =>$allComments,
        'moduleId' => 'unit1'
    ]) ?>
</div>
