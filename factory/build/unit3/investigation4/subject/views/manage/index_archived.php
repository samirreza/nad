<?php

$this->title = 'لیست داده گاه موضوع';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'احداث',
    ['label' => 'واحد 3', 'url' => ['/factory/build/unit3/manage/index']],
    ['label' => 'فعالیت د', 'url' => ['/factory/build/unit3/manage/investigation4']],
    'داده گاه موضوع',
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه موضوع',
        'url' => ['/factory/build/unit3/investigation4/subject/manage/index']
    ],
    [
        'label' => 'داده گاه موضوع',
        'url' => ['/factory/build/unit3/investigation4/subject/manage/archived-index']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/factory/build/unit3/investigation4/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/subject/views/subject/index_archived', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
