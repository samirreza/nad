<?php

$this->title = 'رده‌بندی موضوعها';
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'مراحل', 'url' => ['/engineering/piping/stage/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/piping/stage/manage/investigation-improvement']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/subject/views/category/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
