<?php

$this->title = 'لیست روش';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'احداث',
    ['label' => 'واحد 1', 'url' => ['/factory/build/unit1/manage/index']],
    ['label' => 'فعالیت د', 'url' => ['/factory/build/unit1/manage/investigation4']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/method/views/method/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
