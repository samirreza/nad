<?php

$this->title = 'مدرک ' . $model->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'تکنولوژی های نو', 'url' => ['/newTechnology/manage/index']],
    ['label' => 'سایرگزارشها', 'url' => ['/newTechnology/manage/investigation']],
    'داده گاه موضوع',
    ['label' => 'لیست داده گاه موضوع', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه موضوع',
        'url' => ['/newTechnology/investigation/subject/manage/index']
    ],
    [
        'label' => 'داده گاه موضوع',
        'url' => ['/newTechnology/investigation/subject/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند موضوع',
        'url' => ['/newTechnology/investigation/subject/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/newTechnology/investigation/reference/manage/index']
    ]
];

?>

<div class="subject-view">
    <?= $this->render('@nad/common/modules/investigation/subject/views/subject/view_archived', [
        'model' => $model,
        'moduleId' => 'newTechnology'
    ]) ?>
</div>
