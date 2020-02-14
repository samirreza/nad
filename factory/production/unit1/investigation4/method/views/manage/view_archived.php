<?php

$this->title = 'مدرک ' . $model->title;
$this->params['breadcrumbs'] = [
    'کارخانه',
    'تولید',
    ['label' => 'واحد 1', 'url' => ['/factory/production/unit1/manage/index']],
    ['label' => 'فعالیت د', 'url' => ['/factory/production/unit1/manage/investigation4']],
    'داده گاه روش',
    ['label' => 'لیست داده گاه روش', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه روش',
        'url' => ['/factory/production/unit1/investigation4/method/manage/index']
    ],
    [
        'label' => 'داده گاه روش',
        'url' => ['/factory/production/unit1/investigation4/method/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند روش',
        'url' => ['/factory/production/unit1/investigation4/method/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/factory/production/unit1/investigation4/reference/manage/index']
    ]
];

?>

<div class="method-view">
    <?= $this->render('@nad/common/modules/investigation/method/views/method/view_archived', [
        'model' => $model,
        'moduleId' => 'unit1'
    ]) ?>
</div>
