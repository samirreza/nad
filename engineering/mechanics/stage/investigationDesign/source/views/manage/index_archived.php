<?php

$this->title = 'لیست داده گاه منشا';
$this->params['breadcrumbs'] = [
    'فنی',
    'مکانیک',
    ['label' => 'مراحل', 'url' => ['/engineering/mechanics/stage/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/engineering/mechanics/stage/manage/investigation-design']],
    'داده گاه منشا',
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه منشا',
        'url' => ['/engineering/mechanics/stage/investigationDesign/source/manage/index']
    ],
    [
        'label' => 'داده گاه منشا',
        'url' => ['/engineering/mechanics/stage/investigationDesign/source/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند منشا',
        'url' => ['/engineering/mechanics/stage/investigationDesign/source/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/engineering/mechanics/stage/investigationDesign/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/source/views/source/index_archived', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
