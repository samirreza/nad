<?php

$this->title = 'لیست گزارش';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'تولید',
    ['label' => 'آزمایشگاه', 'url' => ['/factory/production/unit2/manage/index']],
    ['label' => 'فعالیت الف', 'url' => ['/factory/production/unit2/manage/investigation1']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/report/views/report/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
