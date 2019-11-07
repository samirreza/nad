<?php

$this->title = 'رده‌بندی منشا';
$this->params['breadcrumbs'] = [
    'فرایند',
    'مواد',
    ['label' => 'رنگ ها', 'url' => ['/colors/manage/index']],
    ['label' => 'بررسی فرایندی', 'url' => ['/colors/manage/investigation']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/source/views/category/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
