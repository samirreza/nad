<?php

$this->title = 'منشاها';
$this->params['breadcrumbs'] = [
    'فرایند',
    'بررسی، پایش و طراحی',
    ['label' => 'استخر', 'url' => ['/pool/manage/index']],
    ['label' => 'بررسی', 'url' => ['/pool/manage/investigation']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/source/views/source/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
