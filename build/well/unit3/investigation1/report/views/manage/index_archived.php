<?php

$this->title = 'لیست داده گاه گزارش';
$this->params['breadcrumbs'] = [
    'احداث',
    'چاه',
    ['label' => 'واحد 3', 'url' => ['/build/well/unit3/manage/index']],
    ['label' => 'فعالیت الف', 'url' => ['/build/well/unit3/manage/investigation1']],
    'داده گاه گزارش',
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه گزارش',
        'url' => ['/build/well/unit3/investigation1/report/manage/index']
    ],
    [
        'label' => 'داده گاه گزارش',
        'url' => ['/build/well/unit3/investigation1/report/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند گزارش',
        'url' => ['/build/well/unit3/investigation1/report/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/build/well/unit3/investigation1/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/report/views/report/index_archived', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
