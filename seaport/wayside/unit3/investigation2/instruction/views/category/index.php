<?php

$this->title = 'رده‌بندی دستورالعملها';
$this->params['breadcrumbs'] = [
    'بندر',
    'واحد بندر',
    ['label' => 'واحد 3', 'url' => ['/seaport/wayside/unit3/manage/index']],
    ['label' => 'فعالیت ب', 'url' => ['/seaport/wayside/unit3/manage/investigation2']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/instruction/views/category/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
