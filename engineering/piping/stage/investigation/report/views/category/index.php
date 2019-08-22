<?php

$this->title = 'رده‌بندی گزارش‌ها';
$this->params['breadcrumbs'] = [
    'فنی',
    'بررسی، پایش و طراحی',
    ['label' => 'لوله کشی', 'url' => ['/engineering/piping/manage/index']],
    ['label' => 'بررسی', 'url' => ['/engineering/piping/manage/investigation']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/report/views/category/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
