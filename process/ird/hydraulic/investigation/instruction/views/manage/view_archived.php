<?php

$this->title = 'مدرک ' . $model->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'هیدرولیک', 'url' => ['/hydraulic/manage/index']],
    ['label' => 'بررسی فرایندی', 'url' => ['/hydraulic/manage/investigation']],
    'داده گاه دستورالعمل',
    ['label' => 'لیست داده گاه دستورالعمل', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه دستورالعمل',
        'url' => ['/hydraulic/investigation/instruction/manage/index']
    ],
    [
        'label' => 'داده گاه دستورالعمل',
        'url' => ['/hydraulic/investigation/instruction/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند دستورالعمل',
        'url' => ['/hydraulic/investigation/instruction/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/hydraulic/investigation/reference/manage/index']
    ]
];

?>

<div class="instruction-view">
    <?= $this->render('@nad/common/modules/investigation/instruction/views/instruction/view_archived', [
        'model' => $model,
        'moduleId' => 'hydraulic'
    ]) ?>
</div>
