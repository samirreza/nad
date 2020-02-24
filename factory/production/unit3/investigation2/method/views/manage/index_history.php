<?php

$this->title = 'لیست داده گاه روندهای روش';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'تولید',
    ['label' => 'تولید', 'url' => ['/factory/production/unit3/manage/index']],
    ['label' => 'فعالیت ب', 'url' => ['/factory/production/unit3/manage/investigation2']],
    'داده گاه روندهای روش',
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه روش',
        'url' => ['/factory/production/unit3/investigation2/method/manage/index']
    ],
    [
        'label' => 'داده گاه روش',
        'url' => ['/factory/production/unit3/investigation2/method/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند روش',
        'url' => ['/factory/production/unit3/investigation2/method/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/factory/production/unit3/investigation2/reference/manage/index']
    ]
];
?>

<?= $this->render('@nad/common/modules/investigation/method/views/method/index_history', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
