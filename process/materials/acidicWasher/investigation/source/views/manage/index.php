<?php

$this->title = 'لیست منشاهای برنامه';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'شوینده اسدی', 'url' => ['/acidicWasher/manage/index']],
    ['label' => 'بررسی فرایندی', 'url' => ['/acidicWasher/manage/investigation']],
    'برنامه منشا',
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/source/views/source/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
