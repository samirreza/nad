<?php

$this->title = 'لیست گزارش';
$this->params['breadcrumbs'] = [
    'موقت',
    'اداری',
    ['label' => 'واحد 1', 'url' => ['/temporary/administrative/unit1/manage/index']],
    ['label' => 'فعالیت ج', 'url' => ['/temporary/administrative/unit1/manage/investigation3']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/report/views/report/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
