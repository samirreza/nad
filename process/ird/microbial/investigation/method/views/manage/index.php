<?php

$this->title = 'لیست روش‌ها';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'میکروبی', 'url' => ['/microbial/manage/index']],
    ['label' => 'بررسی', 'url' => ['/microbial/manage/investigation']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/method/views/method/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
