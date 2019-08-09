<?php

$this->title = 'لیست منابع';
$this->params['breadcrumbs'] = [
    'فرایند',
    'بررسی، پایش و طراحی',
    ['label' => 'لوله کشی', 'url' => ['/engineering/piping/manage/index']],
    ['label' => 'بررسی', 'url' => ['/engineering/piping/manage/investigation']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/reference/views/reference/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
