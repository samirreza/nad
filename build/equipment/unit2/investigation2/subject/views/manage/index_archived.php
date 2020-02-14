<?php

$this->title = 'لیست داده گاه موضوع';
$this->params['breadcrumbs'] = [
    'احداث',
    'تجهیزات',
    ['label' => 'واحد 2', 'url' => ['/build/equipment/unit2/manage/index']],
    ['label' => 'فعالیت ب', 'url' => ['/build/equipment/unit2/manage/investigation2']],
    'داده گاه موضوع',
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه موضوع',
        'url' => ['/build/equipment/unit2/investigation2/subject/manage/index']
    ],
    [
        'label' => 'داده گاه موضوع',
        'url' => ['/build/equipment/unit2/investigation2/subject/manage/archived-index']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/build/equipment/unit2/investigation2/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/subject/views/subject/index_archived', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
