<?php

$this->title = 'مدرک ' . $model->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'انتقال حرارت', 'url' => ['/heattransfer/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/heattransfer/manage/investigation-design']],
    'داده گاه منشا',
    ['label' => 'لیست داده گاه منشا', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه منشا',
        'url' => ['/heattransfer/investigationDesign/source/manage/index']
    ],
    [
        'label' => 'داده گاه منشا',
        'url' => ['/heattransfer/investigationDesign/source/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند منشا',
        'url' => ['/heattransfer/investigationDesign/source/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/heattransfer/investigationDesign/reference/manage/index']
    ]
];

?>

<div class="source-view">
    <?= $this->render('@nad/common/modules/investigation/source/views/source/view_archived', [
        'model' => $model,
        'moduleId' => 'heattransfer'
    ]) ?>
</div>
