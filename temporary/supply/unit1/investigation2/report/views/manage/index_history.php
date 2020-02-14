<?php

$this->title = 'لیست داده گاه روندهای گزارش';
$this->params['breadcrumbs'] = [
    'موقت',
    'تامین',
    ['label' => 'واحد 1', 'url' => ['/temporary/supply/unit1/manage/index']],
    ['label' => 'فعالیت ب', 'url' => ['/temporary/supply/unit1/manage/investigation2']],
    'داده گاه روندهای گزارش',
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه گزارش',
        'url' => ['/temporary/supply/unit1/investigation2/report/manage/index']
    ],
    [
        'label' => 'داده گاه گزارش',
        'url' => ['/temporary/supply/unit1/investigation2/report/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند گزارش',
        'url' => ['/temporary/supply/unit1/investigation2/report/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/temporary/supply/unit1/investigation2/reference/manage/index']
    ]
];
?>

<?= $this->render('@nad/common/modules/investigation/report/views/report/index_history', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
