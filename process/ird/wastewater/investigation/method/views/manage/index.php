<?php

$this->title = 'لیست روش‌ها';
$this->params['breadcrumbs'] = [
    'فرایند',
    'بررسی، پایش و طراحی',
    ['label' => 'پساب', 'url' => ['/wastewater/manage/index']],
    ['label' => 'بررسی', 'url' => ['/wastewater/manage/investigation']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/method/views/method/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
