<?php

$this->title = 'لیست داده گاه منشا';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'انتقال حرارت', 'url' => ['/heattransfer/manage/index']],
    ['label' => 'بررسی فرایندی', 'url' => ['/heattransfer/manage/investigation']],
    'داده گاه منشا',
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه منشا',
        'url' => ['/heattransfer/investigation/source/manage/index']
    ],
    [
        'label' => 'داده گاه منشا',
        'url' => ['/heattransfer/investigation/source/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند منشا',
        'url' => ['/heattransfer/investigation/source/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/heattransfer/investigation/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/source/views/source/index_archived', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
