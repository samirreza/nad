<?php

$this->title = 'مدرک ' . $model->title;
$this->params['breadcrumbs'] = [
    'بندر',
    'واحد بندر',
    ['label' => 'واحد 2', 'url' => ['/seaport/wayside/unit2/manage/index']],
    ['label' => 'فعالیت ج', 'url' => ['/seaport/wayside/unit2/manage/investigation3']],
    'داده گاه منشا',
    ['label' => 'لیست داده گاه منشا', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه منشا',
        'url' => ['/seaport/wayside/unit2/investigation3/source/manage/index']
    ],
    [
        'label' => 'داده گاه منشا',
        'url' => ['/seaport/wayside/unit2/investigation3/source/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند منشا',
        'url' => ['/seaport/wayside/unit2/investigation3/source/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/seaport/wayside/unit2/investigation3/reference/manage/index']
    ]
];

?>

<div class="source-view">
    <?= $this->render('@nad/common/modules/investigation/source/views/source/view_archived', [
        'model' => $model,
        'moduleId' => 'unit2'
    ]) ?>
</div>
