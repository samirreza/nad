<?php

$this->title = 'شناسنامه ' . $source->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'شوینده اسیدی', 'url' => ['/process/materials/acidicWasher/manage/index']],
    ['label' => 'مطالعات کلی و دستورالعمل ها', 'url' => ['/process/materials/acidicWasher/manage/investigation-design']],
    'داده گاه منشا',
    ['label' => 'لیست داده گاه منشا', 'url' => ['archived-index']],
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه منشا',
        'url' => ['/process/materials/acidicWasher/investigationDesign/source/manage/index']
    ],
    [
        'label' => 'داده گاه منشا',
        'url' => ['/process/materials/acidicWasher/investigationDesign/source/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند منشا',
        'url' => ['/process/materials/acidicWasher/investigationDesign/source/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/process/materials/acidicWasher/investigationDesign/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/source/views/source/certificate_archived', [
    'source' => $source,
    'moduleId' => 'acidicWasher',
    'baseRoute' => '/process/materials/acidicWasher/investigationDesign'
]);
