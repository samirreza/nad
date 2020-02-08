<?php

$this->title = 'لیست داده گاه روندهای دستورالعمل';
$this->params['breadcrumbs'] = [
    'فنی',
    'ژئوتکنیک',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/geotechnics/device/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/engineering/geotechnics/device/manage/investigation-design']],
    'داده گاه روندهای دستورالعمل',
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه دستورالعمل',
        'url' => ['/engineering/geotechnics/device/investigationDesign/instruction/manage/index']
    ],
    [
        'label' => 'داده گاه دستورالعمل',
        'url' => ['/engineering/geotechnics/device/investigationDesign/instruction/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند دستورالعمل',
        'url' => ['/engineering/geotechnics/device/investigationDesign/instruction/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/engineering/geotechnics/device/investigationDesign/reference/manage/index']
    ]
];
?>

<?= $this->render('@nad/common/modules/investigation/instruction/views/instruction/index_history', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
