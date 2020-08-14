<?php

$this->title = 'مدرک ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'مراحل', 'url' => ['/engineering/piping/stage/manage/index']],
    ['label' => 'کنترل کیفیت', 'url' => ['/engineering/piping/stage/manage/investigation4']],
    'داده گاه روش',
    ['label' => 'لیست داده گاه روش', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه روش',
        'url' => ['/engineering/piping/stage/investigation4/method/manage/index']
    ],
    [
        'label' => 'داده گاه روش',
        'url' => ['/engineering/piping/stage/investigation4/method/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند روش',
        'url' => ['/engineering/piping/stage/investigation4/method/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/engineering/piping/stage/investigation4/reference/manage/index']
    ]
];

?>

<div class="method-view">
    <?= $this->render('@nad/common/modules/investigation/method/views/method/view_archived', [
        'model' => $model,
        'moduleId' => 'stage'
    ]) ?>
</div>
