<?php

$this->title = 'لیست منشاهای برنامه';
$this->params['breadcrumbs'] = [
    'احداث',
    'چاه',
    ['label' => 'واحد 2', 'url' => ['/build/well/unit2/manage/index']],
    ['label' => 'فعالیت ج', 'url' => ['/build/well/unit2/manage/investigation3']],
    'برنامه منشا',
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/source/views/source/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
