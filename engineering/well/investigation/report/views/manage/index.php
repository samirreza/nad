<?php

$this->title = 'لیست گزارش';
$this->params['breadcrumbs'] = [
    'فنی',
    'بررسی، پایش و طراحی',
    ['label' => 'چاه', 'url' => ['/engineering/well/manage/index']],
    ['label' => 'بررسی', 'url' => ['/engineering/well/manage/investigation']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/report/views/report/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
