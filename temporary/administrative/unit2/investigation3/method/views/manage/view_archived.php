<?php

$this->title = 'مدرک ' . $model->title;
$this->params['breadcrumbs'] = [
    'موقت',
    'اداری',
    ['label' => 'واحد 2', 'url' => ['/temporary/administrative/unit2/manage/index']],
    ['label' => 'فعالیت ج', 'url' => ['/temporary/administrative/unit2/manage/investigation3']],
    'داده گاه روش',
    ['label' => 'لیست داده گاه روش', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه روش',
        'url' => ['/temporary/administrative/unit2/investigation3/method/manage/index']
    ],
    [
        'label' => 'داده گاه روش',
        'url' => ['/temporary/administrative/unit2/investigation3/method/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند روش',
        'url' => ['/temporary/administrative/unit2/investigation3/method/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/temporary/administrative/unit2/investigation3/reference/manage/index']
    ]
];

?>

<div class="method-view">
    <?= $this->render('@nad/common/modules/investigation/method/views/method/view_archived', [
        'model' => $model,
        'moduleId' => 'unit2'
    ]) ?>
</div>
