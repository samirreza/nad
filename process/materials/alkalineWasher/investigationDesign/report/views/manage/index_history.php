<?php

$this->title = 'لیست داده گاه روندهای گزارش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'شوینده قلیایی', 'url' => ['/alkalineWasher/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/alkalineWasher/manage/investigation-design']],
    'داده گاه روندهای گزارش',
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه گزارش',
        'url' => ['/alkalineWasher/investigationDesign/report/manage/index']
    ],
    [
        'label' => 'داده گاه گزارش',
        'url' => ['/alkalineWasher/investigationDesign/report/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند گزارش',
        'url' => ['/alkalineWasher/investigationDesign/report/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/alkalineWasher/investigationDesign/reference/manage/index']
    ]
];
?>

<?= $this->render('@nad/common/modules/investigation/report/views/report/index_history', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
