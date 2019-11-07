<?php

$this->title = 'لیست منابع';
$this->params['breadcrumbs'] = [
    'فرایند',
    'مواد',
    ['label' => 'لاک بیرنگ', 'url' => ['/lacquer/manage/index']],
    ['label' => 'بررسی فرایندی', 'url' => ['/lacquer/manage/investigation']],
    'داده گاه منابع',
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/reference/views/reference/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
