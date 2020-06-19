<?php

$this->title = 'لیست موضوع های فعال';
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'مراحل', 'url' => ['/engineering/piping/device/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/piping/device/manage/investigation-improvement']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/subject/views/subject/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
