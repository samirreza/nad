<?php

$this->title = 'لیست پروپوزال';
$this->params['breadcrumbs'] = [
    'فرایند',
    'بررسی، پایش و طراحی',
    ['label' => 'ته نشینی', 'url' => ['/sedimentation/manage/index']],
    ['label' => 'بررسی', 'url' => ['/sedimentation/manage/investigation']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);