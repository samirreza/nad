<?php

$this->title = 'مدرک ' . $model->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'گرافن', 'url' => ['/graphene/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/graphene/manage/investigation-design']],
    'داده گاه گزارش',
    ['label' => 'لیست داده گاه گزارش', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه گزارش',
        'url' => ['/graphene/investigationDesign/report/manage/index']
    ],
    [
        'label' => 'داده گاه گزارش',
        'url' => ['/graphene/investigationDesign/report/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند گزارش',
        'url' => ['/graphene/investigationDesign/report/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/graphene/investigationDesign/reference/manage/index']
    ]
];

?>

<div class="report-view">
    <?= $this->render('@nad/common/modules/investigation/report/views/report/view_archived', [
        'model' => $model,
        'moduleId' => 'graphene'
    ]) ?>
</div>