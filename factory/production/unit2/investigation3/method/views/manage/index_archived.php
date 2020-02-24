<?php

$this->title = 'لیست داده گاه روش';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'تولید',
    ['label' => 'آزمایشگاه', 'url' => ['/factory/production/unit2/manage/index']],
    ['label' => 'فعالیت ج', 'url' => ['/factory/production/unit2/manage/investigation3']],
    'داده گاه روش',
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه روش',
        'url' => ['/factory/production/unit2/investigation3/method/manage/index']
    ],
    [
        'label' => 'داده گاه روش',
        'url' => ['/factory/production/unit2/investigation3/method/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند روش',
        'url' => ['/factory/production/unit2/investigation3/method/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/factory/production/unit2/investigation3/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/method/views/method/index_archived', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
