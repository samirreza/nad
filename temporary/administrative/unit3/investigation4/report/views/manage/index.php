<?php

$this->title = 'لیست گزارش';
$this->params['breadcrumbs'] = [
    'موقت',
    'اداری',
    ['label' => 'واحد 3', 'url' => ['/temporary/administrative/unit3/manage/index']],
    ['label' => 'فعالیت د', 'url' => ['/temporary/administrative/unit3/manage/investigation4']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/report/views/report/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
