<?php

$this->title = 'لیست داده گاه روندهای روش';
$this->params['breadcrumbs'] = [
    'موقت',
    'اداری',
    ['label' => 'واحد 3', 'url' => ['/temporary/administrative/unit3/manage/index']],
    ['label' => 'فعالیت ب', 'url' => ['/temporary/administrative/unit3/manage/investigation2']],
    'داده گاه روندهای روش',
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه روش',
        'url' => ['/temporary/administrative/unit3/investigation2/method/manage/index']
    ],
    [
        'label' => 'داده گاه روش',
        'url' => ['/temporary/administrative/unit3/investigation2/method/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند روش',
        'url' => ['/temporary/administrative/unit3/investigation2/method/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/temporary/administrative/unit3/investigation2/reference/manage/index']
    ]
];
?>

<?= $this->render('@nad/common/modules/investigation/method/views/method/index_history', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
