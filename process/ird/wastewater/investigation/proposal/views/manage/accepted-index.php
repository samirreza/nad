<?php

$this->title = 'لیست پروپوزال‌های تایید شده';
$this->params['breadcrumbs'] = [
    'فرایند',
    'بررسی، پایش و طراحی',
    ['label' => 'پساب', 'url' => ['/wastewater/manage/index']],
    ['label' => 'بررسی', 'url' => ['/wastewater/manage/investigation']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/accepted-index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
