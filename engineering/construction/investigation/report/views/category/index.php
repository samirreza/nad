<?php

$this->title = 'رده‌بندی گزارش‌ها';
$this->params['breadcrumbs'] = [
    'فرایند',
    'بررسی، پایش و طراحی',
    ['label' => 'ساختمان', 'url' => ['/engineering/construction/manage/index']],
    ['label' => 'بررسی', 'url' => ['/engineering/construction/manage/investigation']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/report/views/category/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
