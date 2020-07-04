<?php

$this->title = 'رده‌بندی روشها';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'ته نشینی', 'url' => ['/process/ird/sedimentation/manage/index']],
    ['label' => 'بررسی پایش', 'url' => ['/process/ird/sedimentation/manage/investigation-monitor']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/method/views/category/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
