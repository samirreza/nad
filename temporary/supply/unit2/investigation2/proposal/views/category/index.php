<?php

$this->title = 'رده‌بندی پروپوزال';
$this->params['breadcrumbs'] = [
    'موقت',
    'تامین',
    ['label' => 'واحد 2', 'url' => ['/temporary/supply/unit2/manage/index']],
    ['label' => 'فعالیت ب', 'url' => ['/temporary/supply/unit2/manage/investigation2']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/proposal/views/category/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
