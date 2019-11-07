<?php

$this->title = 'لیست داده گاه پروپوزال';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'لاک بیرنگ', 'url' => ['/lacquer/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/lacquer/manage/investigation-design']],
    'داده گاه پروپوزال',
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه پروپوزال',
        'url' => ['/lacquer/investigationDesign/proposal/manage/index']
    ],
    [
        'label' => 'داده گاه پروپوزال',
        'url' => ['/lacquer/investigationDesign/proposal/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند پروپوزال',
        'url' => ['/lacquer/investigationDesign/proposal/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/lacquer/investigationDesign/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/index_archived', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
