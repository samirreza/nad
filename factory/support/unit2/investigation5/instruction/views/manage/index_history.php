<?php

$this->title = 'لیست داده گاه روندهای دستورالعمل';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'پشتیبانی',
    ['label' => 'واحد 2', 'url' => ['/factory/support/unit2/manage/index']],
    ['label' => 'فعالیت ه', 'url' => ['/factory/support/unit2/manage/investigation5']],
    'داده گاه روندهای دستورالعمل',
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه دستورالعمل',
        'url' => ['/factory/support/unit2/investigation5/instruction/manage/index']
    ],
    [
        'label' => 'داده گاه دستورالعمل',
        'url' => ['/factory/support/unit2/investigation5/instruction/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند دستورالعمل',
        'url' => ['/factory/support/unit2/investigation5/instruction/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/factory/support/unit2/investigation5/reference/manage/index']
    ]
];
?>

<?= $this->render('@nad/common/modules/investigation/instruction/views/instruction/index_history', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
