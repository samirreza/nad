<?php

$this->title = 'مدرک ' . $model->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'گرافن', 'url' => ['/process/ird/graphene/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/process/ird/graphene/manage/investigation-design']],
    'داده گاه گزارش',
    ['label' => 'لیست داده گاه گزارش', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه گزارش',
        'url' => ['/process/ird/graphene/investigationDesign/report/manage/index']
    ],
    [
        'label' => 'داده گاه گزارش',
        'url' => ['/process/ird/graphene/investigationDesign/report/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند گزارش',
        'url' => ['/process/ird/graphene/investigationDesign/report/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/process/ird/graphene/investigationDesign/reference/manage/index']
    ]
];

?>

<div class="report-view">
    <?= $this->render('@nad/common/modules/investigation/report/views/report/view_archived', [
        'model' => $model,
        'moduleId' => 'graphene'
    ]) ?>
</div>
