<?php

$this->title = 'لیست پروپوزالهای برنامه';
$this->params['breadcrumbs'] = [
    'بندر',
    'واحد بندر',
    ['label' => 'واحد 1', 'url' => ['/seaport/wayside/unit1/manage/index']],
    ['label' => 'فعالیت ه', 'url' => ['/seaport/wayside/unit1/manage/investigation5']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
