<?php

$this->title = 'لیست داده گاه روندهای دستورالعمل';
$this->params['breadcrumbs'] = [
    'احداث',
    'چاه',
    ['label' => 'واحد 2', 'url' => ['/build/well/unit2/manage/index']],
    ['label' => 'فعالیت ب', 'url' => ['/build/well/unit2/manage/investigation2']],
    'داده گاه روندهای دستورالعمل',
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه دستورالعمل',
        'url' => ['/build/well/unit2/investigation2/instruction/manage/index']
    ],
    [
        'label' => 'داده گاه دستورالعمل',
        'url' => ['/build/well/unit2/investigation2/instruction/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند دستورالعمل',
        'url' => ['/build/well/unit2/investigation2/instruction/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/build/well/unit2/investigation2/reference/manage/index']
    ]
];
?>

<?= $this->render('@nad/common/modules/investigation/instruction/views/instruction/index_history', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
