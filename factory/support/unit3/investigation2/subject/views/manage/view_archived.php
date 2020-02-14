<?php

$this->title = 'مدرک ' . $model->title;
$this->params['breadcrumbs'] = [
    'کارخانه',
    'پشتیبانی',
    ['label' => 'واحد 3', 'url' => ['/factory/support/unit3/manage/index']],
    ['label' => 'فعالیت ب', 'url' => ['/factory/support/unit3/manage/investigation2']],
    'داده گاه موضوع',
    ['label' => 'لیست داده گاه موضوع', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه موضوع',
        'url' => ['/factory/support/unit3/investigation2/subject/manage/index']
    ],
    [
        'label' => 'داده گاه موضوع',
        'url' => ['/factory/support/unit3/investigation2/subject/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند موضوع',
        'url' => ['/factory/support/unit3/investigation2/subject/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/factory/support/unit3/investigation2/reference/manage/index']
    ]
];

?>

<div class="subject-view">
    <?= $this->render('@nad/common/modules/investigation/subject/views/subject/view_archived', [
        'model' => $model,
        'moduleId' => 'unit3'
    ]) ?>
</div>
