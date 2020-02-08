<?php

$this->title = 'رده‌بندی تجهیزات';
$this->params['breadcrumbs'] = [
    'فنی',
    'مکانیک',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/mechanics/device/manage/index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/device/views/category/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
