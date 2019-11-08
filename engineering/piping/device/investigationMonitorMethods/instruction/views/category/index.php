<?php

$this->title = 'رده‌بندی دستورالعملها';
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/piping/device/manage/index']],
    ['label' => 'بررسی روشهای پایش', 'url' => ['/engineering/piping/device/manage/investigation-monitor-methods']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/instruction/views/category/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
