<?php

$this->title = 'لیست داده گاه روش';
$this->params['breadcrumbs'] = [
    'موقت',
    'تامین',
    ['label' => 'واحد 2', 'url' => ['/temporary/supply/unit2/manage/index']],
    ['label' => 'فعالیت ه', 'url' => ['/temporary/supply/unit2/manage/investigation5']],
    'داده گاه روش',
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه روش',
        'url' => ['/temporary/supply/unit2/investigation5/method/manage/index']
    ],
    [
        'label' => 'داده گاه روش',
        'url' => ['/temporary/supply/unit2/investigation5/method/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند روش',
        'url' => ['/temporary/supply/unit2/investigation5/method/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/temporary/supply/unit2/investigation5/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/method/views/method/index_archived', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
