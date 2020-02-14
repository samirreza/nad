<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'کارخانه',
    'تولید',
    ['label' => 'واحد 2', 'url' => ['/factory/production/unit2/manage/index']],
    ['label' => 'فعالیت ب', 'url' => ['/factory/production/unit2/manage/investigation2']],
    'داده گاه روندهای روش',
    ['label' => 'لیست داده گاه روندهای روش', 'url' => ['index-history']],
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه روش',
        'url' => ['/factory/production/unit2/investigation2/method/manage/index']
    ],
    [
        'label' => 'داده گاه روش',
        'url' => ['/factory/production/unit2/investigation2/method/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند روش',
        'url' => ['/factory/production/unit2/investigation2/method/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/factory/production/unit2/investigation2/reference/manage/index']
    ]
];

?>

<div class="method-view">
    <?= $this->render('@nad/common/modules/investigation/method/views/method/view_history', [
        'model' => $model,
        'logs' => $logs,
        'logCounter' => $logCounter,
        'allComments' =>$allComments,
        'moduleId' => 'unit2'
    ]) ?>
</div>
