<?php

$this->title = 'لیست داده گاه روندهای روش';
$this->params['breadcrumbs'] = [
    'احداث',
    'چاه',
    ['label' => 'واحد 3', 'url' => ['/build/well/unit3/manage/index']],
    ['label' => 'فعالیت د', 'url' => ['/build/well/unit3/manage/investigation4']],
    'داده گاه روندهای روش',
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه روش',
        'url' => ['/build/well/unit3/investigation4/method/manage/index']
    ],
    [
        'label' => 'داده گاه روش',
        'url' => ['/build/well/unit3/investigation4/method/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند روش',
        'url' => ['/build/well/unit3/investigation4/method/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/build/well/unit3/investigation4/reference/manage/index']
    ]
];
?>

<?= $this->render('@nad/common/modules/investigation/method/views/method/index_history', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
