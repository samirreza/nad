<?php

$this->title = 'مدرک ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'ساختمان',
    ['label' => 'مراحل', 'url' => ['/engineering/construction/stage/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/engineering/construction/stage/manage/investigation-design']],
    'داده گاه پروپوزال',
    ['label' => 'لیست داده گاه پروپوزال', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه پروپوزال',
        'url' => ['/engineering/construction/stage/investigationDesign/proposal/manage/index']
    ],
    [
        'label' => 'داده گاه پروپوزال',
        'url' => ['/engineering/construction/stage/investigationDesign/proposal/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند پروپوزال',
        'url' => ['/engineering/construction/stage/investigationDesign/proposal/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/engineering/construction/stage/investigationDesign/reference/manage/index']
    ]
];

?>

<div class="proposal-view">
    <?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/view_archived', [
        'model' => $model,
        'moduleId' => 'stage'
    ]) ?>
</div>
