<?php

$this->title = 'رده‌بندی منشا';
$this->params['breadcrumbs'] = [
    'فرایند',
    'آزمایشگاه',
    ['label' => 'واحد 2', 'url' => ['/process/laboratory/unit2/manage/index']],
    ['label' => 'فعالیت بررسی', 'url' => ['/process/laboratory/unit2/manage/investigation1']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/source/views/category/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
