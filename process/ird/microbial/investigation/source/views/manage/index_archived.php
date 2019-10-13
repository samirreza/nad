<?php

$this->title = 'لیست داده گاه منشا';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'میکروبیولوژی', 'url' => ['/microbial/manage/index']],
    ['label' => 'بررسی فرایندی', 'url' => ['/microbial/manage/investigation']],
    'داده گاه منشا',
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'لیست داده گاه منشا',
        'url' => ['/microbial/investigation/source/manage/archived-index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/source/views/source/index_archived', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
