<?php

$this->title = 'لیست داده گاه پروپوزال';
$this->params['breadcrumbs'] = [
    'موقت',
    'تامین',
    ['label' => 'واحد 3', 'url' => ['/temporary/supply/unit3/manage/index']],
    ['label' => 'فعالیت ه', 'url' => ['/temporary/supply/unit3/manage/investigation5']],
    'داده گاه پروپوزال',
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه پروپوزال',
        'url' => ['/temporary/supply/unit3/investigation5/proposal/manage/index']
    ],
    [
        'label' => 'داده گاه پروپوزال',
        'url' => ['/temporary/supply/unit3/investigation5/proposal/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند پروپوزال',
        'url' => ['/temporary/supply/unit3/investigation5/proposal/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/temporary/supply/unit3/investigation5/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/index_archived', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
