<?php

$this->title = 'لیست داده گاه موضوع';
$this->params['breadcrumbs'] = [
    'بندر',
    'واحد بندر',
    ['label' => 'واحد 1', 'url' => ['/seaport/wayside/unit1/manage/index']],
    ['label' => 'فعالیت ج', 'url' => ['/seaport/wayside/unit1/manage/investigation3']],
    'داده گاه موضوع',
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه موضوع',
        'url' => ['/seaport/wayside/unit1/investigation3/subject/manage/index']
    ],
    [
        'label' => 'داده گاه موضوع',
        'url' => ['/seaport/wayside/unit1/investigation3/subject/manage/archived-index']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/seaport/wayside/unit1/investigation3/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/subject/views/subject/index_archived', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
