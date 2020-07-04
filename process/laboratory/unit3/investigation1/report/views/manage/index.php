<?php

$this->title = 'لیست گزارش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'آزمایشگاه',
    ['label' => 'واحد 3', 'url' => ['/process/laboratory/unit3/manage/index']],
    ['label' => 'فعالیت بررسی', 'url' => ['/process/laboratory/unit3/manage/investigation1']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/report/views/report/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
