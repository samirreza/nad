<?php

$this->title = 'لیست داده گاه روش';
$this->params['breadcrumbs'] = [
    'احداث',
    'تجهیزات',
    ['label' => 'واحد 1', 'url' => ['/build/equipment/unit1/manage/index']],
    ['label' => 'فعالیت ب', 'url' => ['/build/equipment/unit1/manage/investigation2']],
    'داده گاه روش',
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه روش',
        'url' => ['/build/equipment/unit1/investigation2/method/manage/index']
    ],
    [
        'label' => 'داده گاه روش',
        'url' => ['/build/equipment/unit1/investigation2/method/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند روش',
        'url' => ['/build/equipment/unit1/investigation2/method/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/build/equipment/unit1/investigation2/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/method/views/method/index_archived', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
