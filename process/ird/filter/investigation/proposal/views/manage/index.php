<?php

$this->title = 'لیست پروپوزال';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'فیلتر', 'url' => ['/filter/manage/index']],
    ['label' => 'بررسی', 'url' => ['/filter/manage/investigation']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
