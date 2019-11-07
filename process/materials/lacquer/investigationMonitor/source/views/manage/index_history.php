<?php

$this->title = 'لیست داده گاه روندهای منشا';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'لاک بیرنگ', 'url' => ['/lacquer/manage/index']],
    ['label' => 'بررسی پایش', 'url' => ['/lacquer/manage/investigation-monitor']],
    'داده گاه روندهای منشا',
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه منشا',
        'url' => ['/lacquer/investigationMonitor/source/manage/index']
    ],
    [
        'label' => 'داده گاه منشا',
        'url' => ['/lacquer/investigationMonitor/source/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روندهای منشا',
        'url' => ['/lacquer/investigationMonitor/source/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/lacquer/investigationMonitor/reference/manage/index']
    ]
];
?>

<?= $this->render('@nad/common/modules/investigation/source/views/source/index_history', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
