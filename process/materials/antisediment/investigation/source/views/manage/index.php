<?php

$this->title = 'لیست منشاهای برنامه';
$this->params['breadcrumbs'] = [
    'فرایند',
    'مواد',
    ['label' => 'ضدرسوب', 'url' => ['/antisediment/manage/index']],
    ['label' => 'بررسی فرایندی', 'url' => ['/antisediment/manage/investigation']],
    'برنامه منشا',
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/source/views/source/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
