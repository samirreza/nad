<?php

$this->title = 'لیست داده گاه روندهای پروپوزال';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'احداث',
    ['label' => 'واحد 2', 'url' => ['/factory/build/unit2/manage/index']],
    ['label' => 'فعالیت ب', 'url' => ['/factory/build/unit2/manage/investigation2']],
    'داده گاه روندهای پروپوزال',
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه پروپوزال',
        'url' => ['/factory/build/unit2/investigation2/proposal/manage/index']
    ],
    [
        'label' => 'داده گاه پروپوزال',
        'url' => ['/factory/build/unit2/investigation2/proposal/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند پروپوزال',
        'url' => ['/factory/build/unit2/investigation2/proposal/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/factory/build/unit2/investigation2/reference/manage/index']
    ]
];
?>

<?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/index_history', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
