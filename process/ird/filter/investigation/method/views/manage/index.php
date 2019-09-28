<?php

$this->title = 'لیست روش‌ها';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'فیلتر شنی', 'url' => ['/filter/manage/index']],
    ['label' => 'بررسی', 'url' => ['/filter/manage/investigation']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/method/views/method/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
