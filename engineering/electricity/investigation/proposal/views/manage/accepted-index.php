<?php

$this->title = 'لیست پروپوزال‌های تایید شده';
$this->params['breadcrumbs'] = [
    'فرایند',
    'بررسی، پایش و طراحی',
    ['label' => 'برق', 'url' => ['/engineering/electricity/manage/index']],
    ['label' => 'بررسی', 'url' => ['/engineering/electricity/manage/investigation']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/accepted-index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
