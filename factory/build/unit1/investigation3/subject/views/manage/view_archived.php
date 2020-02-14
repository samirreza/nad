<?php

$this->title = 'مدرک ' . $model->title;
$this->params['breadcrumbs'] = [
    'کارخانه',
    'احداث',
    ['label' => 'واحد 1', 'url' => ['/factory/build/unit1/manage/index']],
    ['label' => 'فعالیت ج', 'url' => ['/factory/build/unit1/manage/investigation3']],
    'داده گاه موضوع',
    ['label' => 'لیست داده گاه موضوع', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه موضوع',
        'url' => ['/factory/build/unit1/investigation3/subject/manage/index']
    ],
    [
        'label' => 'داده گاه موضوع',
        'url' => ['/factory/build/unit1/investigation3/subject/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند موضوع',
        'url' => ['/factory/build/unit1/investigation3/subject/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/factory/build/unit1/investigation3/reference/manage/index']
    ]
];

?>

<div class="subject-view">
    <?= $this->render('@nad/common/modules/investigation/subject/views/subject/view_archived', [
        'model' => $model,
        'moduleId' => 'unit1'
    ]) ?>
</div>
