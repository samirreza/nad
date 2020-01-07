<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'تکنولوژی های نو', 'url' => ['/newTechnology/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/newTechnology/manage/investigation-design']],
    'داده گاه روندهای دستورالعمل',
    ['label' => 'لیست داده گاه روندهای دستورالعمل', 'url' => ['index-history']],
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه دستورالعمل',
        'url' => ['/newTechnology/investigationDesign/instruction/manage/index']
    ],
    [
        'label' => 'داده گاه دستورالعمل',
        'url' => ['/newTechnology/investigationDesign/instruction/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند دستورالعمل',
        'url' => ['/newTechnology/investigationDesign/instruction/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/newTechnology/investigationDesign/reference/manage/index']
    ]
];

?>

<div class="instruction-view">
    <?= $this->render('@nad/common/modules/investigation/instruction/views/instruction/view_history', [
        'model' => $model,
        'logs' => $logs,
        'logCounter' => $logCounter,
        'allComments' =>$allComments,
        'moduleId' => 'newTechnology'
    ]) ?>
</div>
