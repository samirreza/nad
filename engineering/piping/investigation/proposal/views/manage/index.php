<?php

$this->title = 'لیست پروپوزال';
$this->params['breadcrumbs'] = [
    'فنی',
    'بررسی، پایش و طراحی',
    ['label' => 'لوله کشی', 'url' => ['/engineering/piping/manage/index']],
    ['label' => 'بررسی', 'url' => ['/engineering/piping/manage/investigation']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
