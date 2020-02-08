<?php

$this->title = 'لیست داده گاه دستورالعمل';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'هیدرولیک', 'url' => ['/hydraulic/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/hydraulic/manage/investigation-design']],
    'داده گاه دستورالعمل',
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه دستورالعمل',
        'url' => ['/hydraulic/investigationDesign/instruction/manage/index']
    ],
    [
        'label' => 'داده گاه دستورالعمل',
        'url' => ['/hydraulic/investigationDesign/instruction/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند دستورالعمل',
        'url' => ['/hydraulic/investigationDesign/instruction/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/hydraulic/investigationDesign/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/instruction/views/instruction/index_archived', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
