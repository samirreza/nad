<?php

$this->title = 'لیست روش‌ها';
$this->params['breadcrumbs'] = [
    'فرایند',
    'بررسی، پایش و طراحی',
    ['label' => 'ابزار دقیق', 'url' => ['/engineering/instrument/manage/index']],
    ['label' => 'بررسی', 'url' => ['/engineering/instrument/manage/investigation']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/method/views/method/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
