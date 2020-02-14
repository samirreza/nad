<?php

$this->title = 'مدرک ' . $model->title;
$this->params['breadcrumbs'] = [
    'کارخانه',
    'احداث',
    ['label' => 'واحد 3', 'url' => ['/factory/build/unit3/manage/index']],
    ['label' => 'فعالیت الف', 'url' => ['/factory/build/unit3/manage/investigation1']],
    'داده گاه روش',
    ['label' => 'لیست داده گاه روش', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه روش',
        'url' => ['/factory/build/unit3/investigation1/method/manage/index']
    ],
    [
        'label' => 'داده گاه روش',
        'url' => ['/factory/build/unit3/investigation1/method/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند روش',
        'url' => ['/factory/build/unit3/investigation1/method/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/factory/build/unit3/investigation1/reference/manage/index']
    ]
];

?>

<div class="method-view">
    <?= $this->render('@nad/common/modules/investigation/method/views/method/view_archived', [
        'model' => $model,
        'moduleId' => 'unit3'
    ]) ?>
</div>
