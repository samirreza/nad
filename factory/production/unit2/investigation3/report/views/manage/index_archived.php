<?php

$this->title = 'لیست داده گاه گزارش';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'تولید',
    ['label' => 'آزمایشگاه', 'url' => ['/factory/production/unit2/manage/index']],
    ['label' => 'فعالیت ج', 'url' => ['/factory/production/unit2/manage/investigation3']],
    'داده گاه گزارش',
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه گزارش',
        'url' => ['/factory/production/unit2/investigation3/report/manage/index']
    ],
    [
        'label' => 'داده گاه گزارش',
        'url' => ['/factory/production/unit2/investigation3/report/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند گزارش',
        'url' => ['/factory/production/unit2/investigation3/report/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/factory/production/unit2/investigation3/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/report/views/report/index_archived', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
