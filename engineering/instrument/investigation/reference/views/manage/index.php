<?php

$this->title = 'لیست منابع';
$this->params['breadcrumbs'] = [
    'فرایند',
    'بررسی، پایش و طراحی',
    ['label' => 'ابزار دقیق', 'url' => ['/engineering/instrument/manage/index']],
    ['label' => 'بررسی', 'url' => ['/engineering/instrument/manage/investigation']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/reference/views/reference/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
