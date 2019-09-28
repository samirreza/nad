<?php

$this->title = 'لیست منشا';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'استخر', 'url' => ['/pool/manage/index']],
    ['label' => 'بررسی', 'url' => ['/pool/manage/investigation']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/source/views/source/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
