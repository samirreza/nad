<?php

$this->title = 'رده‌بندی تجهیزات';
$this->params['breadcrumbs'] = [
    'فنی',
    'ابزار دقیق',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/instrument/device/manage/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/device/views/category/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
