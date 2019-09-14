<?php

$this->title = 'لیست پروپوزال';
$this->params['breadcrumbs'] = [
    'فرایند',
    'بررسی، پایش و طراحی',
    ['label' => 'گرافن', 'url' => ['/graphene/manage/index']],
    ['label' => 'بررسی', 'url' => ['/graphene/manage/investigation']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
