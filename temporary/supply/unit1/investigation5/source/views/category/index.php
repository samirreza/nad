<?php

$this->title = 'رده‌بندی منشا';
$this->params['breadcrumbs'] = [
    'موقت',
    'تامین',
    ['label' => 'واحد 1', 'url' => ['/temporary/supply/unit1/manage/index']],
    ['label' => 'فعالیت ه', 'url' => ['/temporary/supply/unit1/manage/investigation5']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/source/views/category/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
