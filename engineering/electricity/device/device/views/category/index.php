<?php

$this->title = 'رده‌بندی تجهیزات';
$this->params['breadcrumbs'] = [
    'فنی',
    'برق',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/electricity/device/manage/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/device/views/category/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
