<?php

$this->title = 'لیست داده گاه روندهای دستورالعمل';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'احداث',
    ['label' => 'واحد 3', 'url' => ['/factory/build/unit3/manage/index']],
    ['label' => 'فعالیت ه', 'url' => ['/factory/build/unit3/manage/investigation5']],
    'داده گاه روندهای دستورالعمل',
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه دستورالعمل',
        'url' => ['/factory/build/unit3/investigation5/instruction/manage/index']
    ],
    [
        'label' => 'داده گاه دستورالعمل',
        'url' => ['/factory/build/unit3/investigation5/instruction/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند دستورالعمل',
        'url' => ['/factory/build/unit3/investigation5/instruction/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/factory/build/unit3/investigation5/reference/manage/index']
    ]
];
?>

<?= $this->render('@nad/common/modules/investigation/instruction/views/instruction/index_history', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
