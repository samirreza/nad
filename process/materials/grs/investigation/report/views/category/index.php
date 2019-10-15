<?php

$this->title = 'رده‌بندی گزارش‌ها';
$this->params['breadcrumbs'] = [
    'فرایند',
    'مواد',
    ['label' => 'جی آر اس', 'url' => ['/grs/manage/index']],
    ['label' => 'بررسی', 'url' => ['/grs/manage/investigation']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/report/views/category/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
