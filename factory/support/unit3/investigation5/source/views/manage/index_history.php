<?php

$this->title = 'لیست داده گاه روندهای منشا';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'پشتیبانی',
    ['label' => 'واحد 3', 'url' => ['/factory/support/unit3/manage/index']],
    ['label' => 'فعالیت ه', 'url' => ['/factory/support/unit3/manage/investigation5']],
    'داده گاه روندهای منشا',
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه منشا',
        'url' => ['/factory/support/unit3/investigation5/source/manage/index']
    ],
    [
        'label' => 'داده گاه منشا',
        'url' => ['/factory/support/unit3/investigation5/source/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند منشا',
        'url' => ['/factory/support/unit3/investigation5/source/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/factory/support/unit3/investigation5/reference/manage/index']
    ]
];
?>

<?= $this->render('@nad/common/modules/investigation/source/views/source/index_history', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
