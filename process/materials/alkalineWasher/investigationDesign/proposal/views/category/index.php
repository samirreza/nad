<?php

$this->title = 'رده‌بندی پروپوزال';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'شوینده قلیایی', 'url' => ['/alkalineWasher/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/alkalineWasher/manage/investigation-design']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/proposal/views/category/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);