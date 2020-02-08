<?php

$this->title = 'رده‌بندی تجهیزات';
$this->params['breadcrumbs'] = [
    'فنی',
    'ژئوتکنیک',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/geotechnics/device/manage/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/device/views/category/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
