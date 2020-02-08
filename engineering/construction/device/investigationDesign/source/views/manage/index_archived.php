<?php

$this->title = 'لیست داده گاه منشا';
$this->params['breadcrumbs'] = [
    'فنی',
    'ساختمان',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/construction/device/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/engineering/construction/device/manage/investigation-design']],
    'داده گاه منشا',
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه منشا',
        'url' => ['/engineering/construction/device/investigationDesign/source/manage/index']
    ],
    [
        'label' => 'داده گاه منشا',
        'url' => ['/engineering/construction/device/investigationDesign/source/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند منشا',
        'url' => ['/engineering/construction/device/investigationDesign/source/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/engineering/construction/device/investigationDesign/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/source/views/source/index_archived', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
