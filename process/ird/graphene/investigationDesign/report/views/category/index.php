<?php

$this->title = 'رده‌بندی گزارش‌ها';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'گرافن', 'url' => ['/graphene/manage/index']],
    ['label' => 'بررسی', 'url' => ['/graphene/manage/investigation-design']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/report/views/category/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
