<?php

$this->title = 'لیست گزارش';
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'مراحل', 'url' => ['/process/materials/disinfectant/manage/index']],
    ['label' => 'مطالعات کلی و دستورالعمل ها', 'url' => ['/process/materials/disinfectant/manage/investigation-design']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/otherreport/views/otherreport/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
