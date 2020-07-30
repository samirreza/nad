<?php

$this->title = 'لیست منابع';
$this->params['breadcrumbs'] = [
    'فرایند',
    'آزمایشگاه',
    ['label' => 'تجهیزات آزمایشگاهی', 'url' => ['/process/laboratory/unit3/manage/index']],
    ['label' => 'فعالیت بررسی', 'url' => ['/process/laboratory/unit3/manage/investigation1']],
    'داده گاه منابع',
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/reference/views/reference/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
