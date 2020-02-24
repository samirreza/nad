<?php

$this->title = 'مدرک ' . $model->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'مواد',
    ['label' => 'لاک بیرنگ', 'url' => ['/lacquer/manage/index']],
    ['label' => 'مطالعات کلی و دستورالعمل ها', 'url' => ['/lacquer/manage/investigation-design']],
    'داده گاه موضوع',
    ['label' => 'لیست داده گاه موضوع', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه موضوع',
        'url' => ['/lacquer/investigationDesign/subject/manage/index']
    ],
    [
        'label' => 'داده گاه موضوع',
        'url' => ['/lacquer/investigationDesign/subject/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند موضوع',
        'url' => ['/lacquer/investigationDesign/subject/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/lacquer/investigationDesign/reference/manage/index']
    ]
];

?>

<div class="subject-view">
    <?= $this->render('@nad/common/modules/investigation/subject/views/subject/view_archived', [
        'model' => $model,
        'moduleId' => 'lacquer'
    ]) ?>
</div>
