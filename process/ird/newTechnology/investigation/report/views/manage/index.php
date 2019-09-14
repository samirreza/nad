<?php

$this->title = 'لیست گزارش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'بررسی، پایش و طراحی',
    ['label' => 'تکنولوژی های نو', 'url' => ['/newTechnology/manage/index']],
    ['label' => 'بررسی', 'url' => ['/newTechnology/manage/investigation']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/report/views/report/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
