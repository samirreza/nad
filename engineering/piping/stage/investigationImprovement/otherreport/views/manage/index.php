<?php

$this->title = 'لیست گزارش';
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'مراحل', 'url' => ['/engineering/piping/stage/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/piping/stage/manage/investigation-improvement']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/otherreport/views/otherreport/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
