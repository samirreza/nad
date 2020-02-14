<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'احداث',
    'چاه',
    ['label' => 'واحد 1', 'url' => ['/build/well/unit1/manage/index']],
    ['label' => 'فعالیت ج', 'url' => ['/build/well/unit1/manage/investigation3']],
    'داده گاه روندهای منشا',
    ['label' => 'لیست داده گاه روندهای منشا', 'url' => ['index-history']],
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه منشا',
        'url' => ['/build/well/unit1/investigation3/source/manage/index']
    ],
    [
        'label' => 'داده گاه منشا',
        'url' => ['/build/well/unit1/investigation3/source/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند منشا',
        'url' => ['/build/well/unit1/investigation3/source/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/build/well/unit1/investigation3/reference/manage/index']
    ]
];

?>

<div class="source-view">
    <?= $this->render('@nad/common/modules/investigation/source/views/source/view_history', [
        'model' => $model,
        'logs' => $logs,
        'logCounter' => $logCounter,
        'allComments' =>$allComments,
        'moduleId' => 'unit1'
    ]) ?>
</div>
