<?php

$this->title = 'لیست منشاهای برنامه';
$this->params['breadcrumbs'] = [
    'موقت',
    'آی تی',
    ['label' => 'واحد 3', 'url' => ['/temporary/informationtech/unit3/manage/index']],
    ['label' => 'فعالیت ج', 'url' => ['/temporary/informationtech/unit3/manage/investigation3']],
    'برنامه منشا',
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/source/views/source/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
