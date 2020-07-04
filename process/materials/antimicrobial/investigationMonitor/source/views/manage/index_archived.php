<?php

$this->title = 'لیست داده گاه منشا';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'ضدمیکروب', 'url' => ['/process/materials/antimicrobial/manage/index']],
    ['label' => 'بررسی پایش', 'url' => ['/process/materials/antimicrobial/manage/investigation-monitor']],
    'داده گاه منشا',
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'لیست داده گاه منشا',
        'url' => ['/process/materials/antimicrobial/investigationMonitor/source/manage/archived-index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/source/views/source/index_archived', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
