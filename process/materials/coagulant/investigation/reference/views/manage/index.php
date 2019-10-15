<?php

$this->title = 'لیست منابع';
$this->params['breadcrumbs'] = [
    'فرایند',
    'مواد',
    ['label' => 'منعقدکننده', 'url' => ['/coagulant/manage/index']],
    ['label' => 'بررسی فرایندی', 'url' => ['/coagulant/manage/investigation']],
    'داده گاه منابع',
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/reference/views/reference/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
