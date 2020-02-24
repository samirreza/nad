<?php

$this->title = 'لیست داده گاه روندهای پروپوزال';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'تولید',
    ['label' => 'تعمیرات و نگهداری', 'url' => ['/factory/production/unit4/manage/index']],
    ['label' => 'فعالیت ب', 'url' => ['/factory/production/unit4/manage/investigation2']],
    'داده گاه روندهای پروپوزال',
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه پروپوزال',
        'url' => ['/factory/production/unit4/investigation2/proposal/manage/index']
    ],
    [
        'label' => 'داده گاه پروپوزال',
        'url' => ['/factory/production/unit4/investigation2/proposal/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند پروپوزال',
        'url' => ['/factory/production/unit4/investigation2/proposal/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/factory/production/unit4/investigation2/reference/manage/index']
    ]
];
?>

<?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/index_history', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
