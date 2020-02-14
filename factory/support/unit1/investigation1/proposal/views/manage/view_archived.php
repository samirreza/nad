<?php

$this->title = 'مدرک ' . $model->title;
$this->params['breadcrumbs'] = [
    'کارخانه',
    'پشتیبانی',
    ['label' => 'واحد 1', 'url' => ['/factory/support/unit1/manage/index']],
    ['label' => 'فعالیت الف', 'url' => ['/factory/support/unit1/manage/investigation1']],
    'داده گاه پروپوزال',
    ['label' => 'لیست داده گاه پروپوزال', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه پروپوزال',
        'url' => ['/factory/support/unit1/investigation1/proposal/manage/index']
    ],
    [
        'label' => 'داده گاه پروپوزال',
        'url' => ['/factory/support/unit1/investigation1/proposal/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند پروپوزال',
        'url' => ['/factory/support/unit1/investigation1/proposal/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/factory/support/unit1/investigation1/reference/manage/index']
    ]
];

?>

<div class="proposal-view">
    <?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/view_archived', [
        'model' => $model,
        'moduleId' => 'unit1'
    ]) ?>
</div>
