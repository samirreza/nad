<?php

$this->title = 'شناسنامه ' . $otherreport->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'مراحل', 'url' => ['/process/materials/disinfectant/manage/index']],
    ['label' => 'مطالعات کلی و دستورالعمل ها', 'url' => ['/process/materials/disinfectant/manage/investigation-design']],
    'داده گاه گزارش',
    ['label' => 'لیست داده گاه گزارش', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه گزارش',
        'url' => ['/process/materials/disinfectant/investigationDesign/otherreport/manage/index']
    ],
    [
        'label' => 'داده گاه گزارش',
        'url' => ['/process/materials/disinfectant/investigationDesign/otherreport/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند گزارش',
        'url' => ['/process/materials/disinfectant/investigationDesign/otherreport/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/process/materials/disinfectant/investigationDesign/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/otherreport/views/otherreport/certificate_archived', [
   'subject' => $subject,
   'otherreport' => $otherreport,
    'moduleId' => 'disinfectant',
    'baseRoute' => '/process/materials/disinfectant/investigationDesign'
]);
