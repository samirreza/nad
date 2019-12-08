<?php

$this->title = 'رده‌بندی تجهیزات';
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/piping/device/manage/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/device/views/category/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
