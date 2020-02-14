<?php

$this->title = 'مدرک ' . $model->title;
$this->params['breadcrumbs'] = [
    'موقت',
    'آی تی',
    ['label' => 'واحد 1', 'url' => ['/temporary/informationtech/unit1/manage/index']],
    ['label' => 'فعالیت ج', 'url' => ['/temporary/informationtech/unit1/manage/investigation3']],
    'داده گاه موضوع',
    ['label' => 'لیست داده گاه موضوع', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه موضوع',
        'url' => ['/temporary/informationtech/unit1/investigation3/subject/manage/index']
    ],
    [
        'label' => 'داده گاه موضوع',
        'url' => ['/temporary/informationtech/unit1/investigation3/subject/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند موضوع',
        'url' => ['/temporary/informationtech/unit1/investigation3/subject/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/temporary/informationtech/unit1/investigation3/reference/manage/index']
    ]
];

?>

<div class="subject-view">
    <?= $this->render('@nad/common/modules/investigation/subject/views/subject/view_archived', [
        'model' => $model,
        'moduleId' => 'unit1'
    ]) ?>
</div>
