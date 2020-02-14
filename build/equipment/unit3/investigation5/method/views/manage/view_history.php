<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'احداث',
    'تجهیزات',
    ['label' => 'واحد 3', 'url' => ['/build/equipment/unit3/manage/index']],
    ['label' => 'فعالیت ه', 'url' => ['/build/equipment/unit3/manage/investigation5']],
    'داده گاه روندهای روش',
    ['label' => 'لیست داده گاه روندهای روش', 'url' => ['index-history']],
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه روش',
        'url' => ['/build/equipment/unit3/investigation5/method/manage/index']
    ],
    [
        'label' => 'داده گاه روش',
        'url' => ['/build/equipment/unit3/investigation5/method/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند روش',
        'url' => ['/build/equipment/unit3/investigation5/method/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/build/equipment/unit3/investigation5/reference/manage/index']
    ]
];

?>

<div class="method-view">
    <?= $this->render('@nad/common/modules/investigation/method/views/method/view_history', [
        'model' => $model,
        'logs' => $logs,
        'logCounter' => $logCounter,
        'allComments' =>$allComments,
        'moduleId' => 'unit3'
    ]) ?>
</div>
