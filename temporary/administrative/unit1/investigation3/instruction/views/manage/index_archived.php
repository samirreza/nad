<?php

$this->title = 'لیست داده گاه دستورالعمل';
$this->params['breadcrumbs'] = [
    'موقت',
    'اداری',
    ['label' => 'واحد 1', 'url' => ['/temporary/administrative/unit1/manage/index']],
    ['label' => 'فعالیت ج', 'url' => ['/temporary/administrative/unit1/manage/investigation3']],
    'داده گاه دستورالعمل',
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه دستورالعمل',
        'url' => ['/temporary/administrative/unit1/investigation3/instruction/manage/index']
    ],
    [
        'label' => 'داده گاه دستورالعمل',
        'url' => ['/temporary/administrative/unit1/investigation3/instruction/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند دستورالعمل',
        'url' => ['/temporary/administrative/unit1/investigation3/instruction/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/temporary/administrative/unit1/investigation3/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/instruction/views/instruction/index_archived', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
