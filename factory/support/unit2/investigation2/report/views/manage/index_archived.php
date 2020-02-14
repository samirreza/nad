<?php

$this->title = 'لیست داده گاه گزارش';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'پشتیبانی',
    ['label' => 'واحد 2', 'url' => ['/factory/support/unit2/manage/index']],
    ['label' => 'فعالیت ب', 'url' => ['/factory/support/unit2/manage/investigation2']],
    'داده گاه گزارش',
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه گزارش',
        'url' => ['/factory/support/unit2/investigation2/report/manage/index']
    ],
    [
        'label' => 'داده گاه گزارش',
        'url' => ['/factory/support/unit2/investigation2/report/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند گزارش',
        'url' => ['/factory/support/unit2/investigation2/report/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/factory/support/unit2/investigation2/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/report/views/report/index_archived', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
