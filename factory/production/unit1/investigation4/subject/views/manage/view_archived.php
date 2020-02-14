<?php

$this->title = 'مدرک ' . $model->title;
$this->params['breadcrumbs'] = [
    'کارخانه',
    'تولید',
    ['label' => 'واحد 1', 'url' => ['/factory/production/unit1/manage/index']],
    ['label' => 'فعالیت د', 'url' => ['/factory/production/unit1/manage/investigation4']],
    'داده گاه موضوع',
    ['label' => 'لیست داده گاه موضوع', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه موضوع',
        'url' => ['/factory/production/unit1/investigation4/subject/manage/index']
    ],
    [
        'label' => 'داده گاه موضوع',
        'url' => ['/factory/production/unit1/investigation4/subject/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند موضوع',
        'url' => ['/factory/production/unit1/investigation4/subject/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/factory/production/unit1/investigation4/reference/manage/index']
    ]
];

?>

<div class="subject-view">
    <?= $this->render('@nad/common/modules/investigation/subject/views/subject/view_archived', [
        'model' => $model,
        'moduleId' => 'unit1'
    ]) ?>
</div>
