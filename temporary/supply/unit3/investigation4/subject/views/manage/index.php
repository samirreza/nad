<?php

$this->title = 'لیست موضوع های فعال';
$this->params['breadcrumbs'] = [
    'موقت',
    'تامین',
    ['label' => 'واحد 3', 'url' => ['/temporary/supply/unit3/manage/index']],
    ['label' => 'فعالیت د', 'url' => ['/temporary/supply/unit3/manage/investigation4']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/subject/views/subject/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
