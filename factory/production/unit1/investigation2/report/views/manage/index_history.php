<?php

$this->title = 'لیست داده گاه روندهای گزارش';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'تولید',
    ['label' => 'فنی', 'url' => ['/factory/production/unit1/manage/index']],
    ['label' => 'فعالیت ب', 'url' => ['/factory/production/unit1/manage/investigation2']],
    'داده گاه روندهای گزارش',
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه گزارش',
        'url' => ['/factory/production/unit1/investigation2/report/manage/index']
    ],
    [
        'label' => 'داده گاه گزارش',
        'url' => ['/factory/production/unit1/investigation2/report/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند گزارش',
        'url' => ['/factory/production/unit1/investigation2/report/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/factory/production/unit1/investigation2/reference/manage/index']
    ]
];
?>

<?= $this->render('@nad/common/modules/investigation/report/views/report/index_history', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
