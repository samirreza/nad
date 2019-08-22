<?php

$this->title = 'لیست منابع';
$this->params['breadcrumbs'] = [
    'فنی',
    'بررسی، پایش و طراحی',
    ['label' => 'لوله کشی', 'url' => ['/engineering/piping/stage/manage/index']],
    ['label' => 'بررسی', 'url' => ['/engineering/piping/stage/manage/investigation']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/reference/views/reference/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
