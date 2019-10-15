<?php

$this->title = 'رده‌بندی منشا';
$this->params['breadcrumbs'] = [
    'فرایند',
    'مواد',
    ['label' => 'شوینده اسیدی', 'url' => ['/acidicWasher/manage/index']],
    ['label' => 'بررسی فرایندی', 'url' => ['/acidicWasher/manage/investigation']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/source/views/category/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
