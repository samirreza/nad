<?php

$this->title = 'لیست پروپوزال‌های تایید شده';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'استخر', 'url' => ['/pool/manage/index']],
    ['label' => 'بررسی', 'url' => ['/pool/manage/investigation']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/accepted-index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
