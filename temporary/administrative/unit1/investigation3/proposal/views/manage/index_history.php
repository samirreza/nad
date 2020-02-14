<?php

$this->title = 'لیست داده گاه روندهای پروپوزال';
$this->params['breadcrumbs'] = [
    'موقت',
    'اداری',
    ['label' => 'واحد 1', 'url' => ['/temporary/administrative/unit1/manage/index']],
    ['label' => 'فعالیت ج', 'url' => ['/temporary/administrative/unit1/manage/investigation3']],
    'داده گاه روندهای پروپوزال',
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه پروپوزال',
        'url' => ['/temporary/administrative/unit1/investigation3/proposal/manage/index']
    ],
    [
        'label' => 'داده گاه پروپوزال',
        'url' => ['/temporary/administrative/unit1/investigation3/proposal/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند پروپوزال',
        'url' => ['/temporary/administrative/unit1/investigation3/proposal/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/temporary/administrative/unit1/investigation3/reference/manage/index']
    ]
];
?>

<?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/index_history', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
