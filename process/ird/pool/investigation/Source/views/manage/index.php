<?php

$this->title = 'منشاها';
$this->params['breadcrumbs'] = [
    'فرایند',
    'بررسی، پایش و طراحی',
    'استخر',
    'بررسی',
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/source/views/manage/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
