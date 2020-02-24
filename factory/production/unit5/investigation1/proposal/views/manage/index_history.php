<?php

$this->title = 'لیست داده گاه روندهای پروپوزال';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'تولید',
    ['label' => 'انبار', 'url' => ['/factory/production/unit5/manage/index']],
    ['label' => 'فعالیت الف', 'url' => ['/factory/production/unit5/manage/investigation1']],
    'داده گاه روندهای پروپوزال',
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه پروپوزال',
        'url' => ['/factory/production/unit5/investigation1/proposal/manage/index']
    ],
    [
        'label' => 'داده گاه پروپوزال',
        'url' => ['/factory/production/unit5/investigation1/proposal/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند پروپوزال',
        'url' => ['/factory/production/unit5/investigation1/proposal/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/factory/production/unit5/investigation1/reference/manage/index']
    ]
];
?>

<?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/index_history', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
