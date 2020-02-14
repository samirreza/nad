<?php

$this->title = 'رده‌بندی دستورالعملها';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'پشتیبانی',
    ['label' => 'واحد 2', 'url' => ['/factory/support/unit2/manage/index']],
    ['label' => 'فعالیت ه', 'url' => ['/factory/support/unit2/manage/investigation5']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/instruction/views/category/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
