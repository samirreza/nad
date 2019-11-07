<?php

$this->title = 'لیست داده گاه روندهای منشا';
$this->params['breadcrumbs'] = [
    'فرایند',
    'مواد',
    ['label' => 'ضدمیکروب', 'url' => ['/antimicrobial/manage/index']],
    ['label' => 'بررسی فرایندی', 'url' => ['/antimicrobial/manage/investigation']],
    'داده گاه روندهای منشا',
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه منشا',
        'url' => ['/antimicrobial/investigation/source/manage/index']
    ],
    [
        'label' => 'داده گاه منشا',
        'url' => ['/antimicrobial/investigation/source/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روندهای منشا',
        'url' => ['/antimicrobial/investigation/source/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/antimicrobial/investigation/reference/manage/index']
    ]
];
?>

<?= $this->render('@nad/common/modules/investigation/source/views/source/index_history', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
