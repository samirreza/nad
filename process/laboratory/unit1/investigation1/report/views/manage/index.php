<?php

$this->title = 'لیست گزارش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'آزمایشگاه',
    ['label' => 'واحد 1', 'url' => ['/process/laboratory/unit1/manage/index']],
    ['label' => 'فعالیت بررسی', 'url' => ['/process/laboratory/unit1/manage/investigation1']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/report/views/report/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
