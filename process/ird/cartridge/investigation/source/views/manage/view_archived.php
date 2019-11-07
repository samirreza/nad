<?php

$this->title = 'مدرک ' . $model->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'کارتریج', 'url' => ['/cartridge/manage/index']],
    ['label' => 'بررسی فرایندی', 'url' => ['/cartridge/manage/investigation']],
    'داده گاه منشا',
    ['label' => 'لیست داده گاه منشا', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه منشا',
        'url' => ['/cartridge/investigation/source/manage/index']
    ],
    [
        'label' => 'داده گاه منشا',
        'url' => ['/cartridge/investigation/source/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند منشا',
        'url' => ['/cartridge/investigation/source/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/cartridge/investigation/reference/manage/index']
    ]
];

?>

<div class="source-view">
    <?= $this->render('@nad/common/modules/investigation/source/views/source/view_archived', [
        'model' => $model,
        'moduleId' => 'cartridge'
    ]) ?>
</div>
