<?php

$this->title = 'لیست داده گاه گزارش';
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'مراحل', 'url' => ['/process/materials/disinfectant/manage/index']],
    ['label' => 'مطالعات کلی و دستورالعمل ها', 'url' => ['/process/materials/disinfectant/manage/investigation-design']],
    'داده گاه گزارش',
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه گزارش',
        'url' => ['/disinfectant/investigationDesign/otherreport/manage/index']
    ],
    [
        'label' => 'داده گاه گزارش',
        'url' => ['/disinfectant/investigationDesign/otherreport/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند گزارش',
        'url' => ['/disinfectant/investigationDesign/otherreport/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/disinfectant/investigationDesign/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/otherreport/views/otherreport/index_archived', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
