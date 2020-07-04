<?php

$this->title = 'لیست روش‌ها';
$this->params['breadcrumbs'] = [
    'فرایند',
    'مواد',
    ['label' => 'رنگ ها', 'url' => ['/process/materials/colors/manage/index']],
    ['label' => 'بررسی', 'url' => ['/process/materials/colors/manage/investigation']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/method/views/method/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
