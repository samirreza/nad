<?php

$this->title = 'لیست پروپوزال';
$this->params['breadcrumbs'] = [
    'فرایند',
    'مواد',
    ['label' => 'جی آر اس', 'url' => ['/grs/manage/index']],
    ['label' => 'بررسی', 'url' => ['/grs/manage/investigation']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);