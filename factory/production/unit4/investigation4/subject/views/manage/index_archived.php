<?php

$this->title = 'لیست داده گاه موضوع';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'تولید',
    ['label' => 'تعمیرات و نگهداری', 'url' => ['/factory/production/unit4/manage/index']],
    ['label' => 'فعالیت د', 'url' => ['/factory/production/unit4/manage/investigation4']],
    'داده گاه موضوع',
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه موضوع',
        'url' => ['/factory/production/unit4/investigation4/subject/manage/index']
    ],
    [
        'label' => 'داده گاه موضوع',
        'url' => ['/factory/production/unit4/investigation4/subject/manage/archived-index']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/factory/production/unit4/investigation4/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/subject/views/subject/index_archived', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
