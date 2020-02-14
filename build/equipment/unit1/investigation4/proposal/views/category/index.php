<?php

$this->title = 'رده‌بندی پروپوزال';
$this->params['breadcrumbs'] = [
    'احداث',
    'تجهیزات',
    ['label' => 'واحد 1', 'url' => ['/build/equipment/unit1/manage/index']],
    ['label' => 'فعالیت د', 'url' => ['/build/equipment/unit1/manage/investigation4']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/proposal/views/category/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
