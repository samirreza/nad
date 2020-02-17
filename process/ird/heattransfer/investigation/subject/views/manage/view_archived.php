<?php

$this->title = 'مدرک ' . $model->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'انتقال حرارت', 'url' => ['/heattransfer/manage/index']],
    ['label' => 'سایرگزارشها', 'url' => ['/heattransfer/manage/investigation']],
    'داده گاه موضوع',
    ['label' => 'لیست داده گاه موضوع', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه موضوع',
        'url' => ['/heattransfer/investigation/subject/manage/index']
    ],
    [
        'label' => 'داده گاه موضوع',
        'url' => ['/heattransfer/investigation/subject/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند موضوع',
        'url' => ['/heattransfer/investigation/subject/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/heattransfer/investigation/reference/manage/index']
    ]
];

?>

<div class="subject-view">
    <?= $this->render('@nad/common/modules/investigation/subject/views/subject/view_archived', [
        'model' => $model,
        'moduleId' => 'heattransfer'
    ]) ?>
</div>
