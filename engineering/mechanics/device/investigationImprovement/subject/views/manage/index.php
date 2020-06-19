<?php

$this->title = 'لیست موضوع های فعال';
$this->params['breadcrumbs'] = [
    'فنی',
    'مکانیک',
    ['label' => 'مراحل', 'url' => ['/engineering/mechanics/device/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/mechanics/device/manage/investigation-improvement']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/subject/views/subject/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
