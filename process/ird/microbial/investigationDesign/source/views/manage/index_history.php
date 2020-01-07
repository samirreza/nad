<?php

$this->title = 'لیست داده گاه روندهای منشا';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'میکروبیولوژی', 'url' => ['/microbial/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/microbial/manage/investigation-design']],
    'داده گاه روندهای منشا',
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه منشا',
        'url' => ['/microbial/investigationDesign/source/manage/index']
    ],
    [
        'label' => 'داده گاه منشا',
        'url' => ['/microbial/investigationDesign/source/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند منشا',
        'url' => ['/microbial/investigationDesign/source/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/microbial/investigationDesign/reference/manage/index']
    ]
];
?>

<?= $this->render('@nad/common/modules/investigation/source/views/source/index_history', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
