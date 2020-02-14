<?php

$this->title = 'مدرک ' . $model->title;
$this->params['breadcrumbs'] = [
    'کارخانه',
    'پشتیبانی',
    ['label' => 'واحد 2', 'url' => ['/factory/support/unit2/manage/index']],
    ['label' => 'فعالیت ه', 'url' => ['/factory/support/unit2/manage/investigation5']],
    'داده گاه روش',
    ['label' => 'لیست داده گاه روش', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه روش',
        'url' => ['/factory/support/unit2/investigation5/method/manage/index']
    ],
    [
        'label' => 'داده گاه روش',
        'url' => ['/factory/support/unit2/investigation5/method/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند روش',
        'url' => ['/factory/support/unit2/investigation5/method/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/factory/support/unit2/investigation5/reference/manage/index']
    ]
];

?>

<div class="method-view">
    <?= $this->render('@nad/common/modules/investigation/method/views/method/view_archived', [
        'model' => $model,
        'moduleId' => 'unit2'
    ]) ?>
</div>
