<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'کارخانه',
    'احداث',
    ['label' => 'واحد 3', 'url' => ['/factory/build/unit3/manage/index']],
    ['label' => 'فعالیت ه', 'url' => ['/factory/build/unit3/manage/investigation5']],
    'داده گاه روندهای پروپوزال',
    ['label' => 'لیست داده گاه روندهای پروپوزال', 'url' => ['index-history']],
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه پروپوزال',
        'url' => ['/factory/build/unit3/investigation5/proposal/manage/index']
    ],
    [
        'label' => 'داده گاه پروپوزال',
        'url' => ['/factory/build/unit3/investigation5/proposal/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند پروپوزال',
        'url' => ['/factory/build/unit3/investigation5/proposal/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/factory/build/unit3/investigation5/reference/manage/index']
    ]
];

?>

<div class="proposal-view">
    <?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/view_history', [
        'model' => $model,
        'logs' => $logs,
        'logCounter' => $logCounter,
        'allComments' =>$allComments,
        'moduleId' => 'unit3'
    ]) ?>
</div>
