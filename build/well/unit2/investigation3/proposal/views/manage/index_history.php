<?php

$this->title = 'لیست داده گاه روندهای پروپوزال';
$this->params['breadcrumbs'] = [
    'احداث',
    'چاه',
    ['label' => 'واحد 2', 'url' => ['/build/well/unit2/manage/index']],
    ['label' => 'فعالیت ج', 'url' => ['/build/well/unit2/manage/investigation3']],
    'داده گاه روندهای پروپوزال',
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه پروپوزال',
        'url' => ['/build/well/unit2/investigation3/proposal/manage/index']
    ],
    [
        'label' => 'داده گاه پروپوزال',
        'url' => ['/build/well/unit2/investigation3/proposal/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند پروپوزال',
        'url' => ['/build/well/unit2/investigation3/proposal/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/build/well/unit2/investigation3/reference/manage/index']
    ]
];
?>

<?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/index_history', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
