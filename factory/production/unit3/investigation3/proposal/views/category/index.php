<?php

$this->title = 'رده‌بندی پروپوزال';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'تولید',
    ['label' => 'تولید', 'url' => ['/factory/production/unit3/manage/index']],
    ['label' => 'فعالیت ج', 'url' => ['/factory/production/unit3/manage/investigation3']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/proposal/views/category/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
