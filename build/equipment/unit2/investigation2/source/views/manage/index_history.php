<?php

$this->title = 'لیست داده گاه روندهای منشا';
$this->params['breadcrumbs'] = [
    'احداث',
    'تجهیزات',
    ['label' => 'واحد 2', 'url' => ['/build/equipment/unit2/manage/index']],
    ['label' => 'فعالیت ب', 'url' => ['/build/equipment/unit2/manage/investigation2']],
    'داده گاه روندهای منشا',
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه منشا',
        'url' => ['/build/equipment/unit2/investigation2/source/manage/index']
    ],
    [
        'label' => 'داده گاه منشا',
        'url' => ['/build/equipment/unit2/investigation2/source/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند منشا',
        'url' => ['/build/equipment/unit2/investigation2/source/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/build/equipment/unit2/investigation2/reference/manage/index']
    ]
];
?>

<?= $this->render('@nad/common/modules/investigation/source/views/source/index_history', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
