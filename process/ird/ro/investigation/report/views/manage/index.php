<?php

$this->title = 'لیست گزارش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'بررسی، پایش و طراحی',
    ['label' => 'آر او', 'url' => ['/ro/manage/index']],
    ['label' => 'بررسی', 'url' => ['/ro/manage/investigation']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/report/views/report/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
