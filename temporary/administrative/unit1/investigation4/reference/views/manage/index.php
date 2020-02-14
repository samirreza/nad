<?php

$this->title = 'لیست منابع';
$this->params['breadcrumbs'] = [
    'موقت',
    'اداری',
    ['label' => 'واحد 1', 'url' => ['/temporary/administrative/unit1/manage/index']],
    ['label' => 'فعالیت د', 'url' => ['/temporary/administrative/unit1/manage/investigation4']],
    'داده گاه منابع',
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/reference/views/reference/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
