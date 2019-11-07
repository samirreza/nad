<?php

$this->title = 'رده‌بندی گزارش‌ها';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'ضدمیکروب', 'url' => ['/antimicrobial/manage/index']],
    ['label' => 'بررسی', 'url' => ['/antimicrobial/manage/investigation-monitor']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/report/views/category/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
