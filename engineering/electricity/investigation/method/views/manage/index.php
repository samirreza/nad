<?php

$this->title = 'لیست روش‌ها';
$this->params['breadcrumbs'] = [
    'فنی',
    'بررسی، پایش و طراحی',
    ['label' => 'برق', 'url' => ['/engineering/electricity/manage/index']],
    ['label' => 'بررسی', 'url' => ['/engineering/electricity/manage/investigation']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/method/views/method/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
