<?php

$this->title = 'لیست دستورالعمل';
$this->params['breadcrumbs'] = [
    'موقت',
    'اداری',
    ['label' => 'واحد 3', 'url' => ['/temporary/administrative/unit3/manage/index']],
    ['label' => 'فعالیت ه', 'url' => ['/temporary/administrative/unit3/manage/investigation5']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/instruction/views/instruction/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
