<?php

$this->title = 'لیست پروپوزال‌های تایید شده';
$this->params['breadcrumbs'] = [
    'فرایند',
    'مواد',
    ['label' => 'گندزدا', 'url' => ['/disinfectant/manage/index']],
    ['label' => 'بررسی', 'url' => ['/disinfectant/manage/investigation']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/accepted-index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
