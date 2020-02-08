<?php

$this->title = 'مدرک ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'کنترل',
    ['label' => 'مراحل', 'url' => ['/engineering/control/stage/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/engineering/control/stage/manage/investigation-design']],
    'داده گاه منشا',
    ['label' => 'لیست داده گاه منشا', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه منشا',
        'url' => ['/engineering/control/stage/investigationDesign/source/manage/index']
    ],
    [
        'label' => 'داده گاه منشا',
        'url' => ['/engineering/control/stage/investigationDesign/source/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند منشا',
        'url' => ['/engineering/control/stage/investigationDesign/source/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/engineering/control/stage/investigationDesign/reference/manage/index']
    ]
];

?>

<div class="source-view">
    <?= $this->render('@nad/common/modules/investigation/source/views/source/view_archived', [
        'model' => $model,
        'moduleId' => 'stage'
    ]) ?>
</div>
