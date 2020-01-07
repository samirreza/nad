<?php

$this->title = 'رده‌بندی منشا';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'آشنایی', 'url' => ['/introduction/manage/index']],
    ['label' => 'بررسی فرایندی', 'url' => ['/introduction/manage/investigation']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/source/views/category/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
