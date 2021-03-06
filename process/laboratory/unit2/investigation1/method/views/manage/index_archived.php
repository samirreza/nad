<?php

$this->title = 'لیست داده گاه روش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'آزمایشگاه',
    ['label' => 'واحد 2', 'url' => ['/process/laboratory/unit2/manage/index']],
    ['label' => 'فعالیت بررسی', 'url' => ['/process/laboratory/unit2/manage/investigation1']],
    'داده گاه روش',
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه روش',
        'url' => ['/process/laboratory/unit2/investigation1/method/manage/index']
    ],
    [
        'label' => 'داده گاه روش',
        'url' => ['/process/laboratory/unit2/investigation1/method/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند روش',
        'url' => ['/process/laboratory/unit2/investigation1/method/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/process/laboratory/unit2/investigation1/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/method/views/method/index_archived', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
