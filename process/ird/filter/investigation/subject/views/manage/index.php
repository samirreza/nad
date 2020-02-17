<?php

$this->title = 'لیست موضوع های فعال';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'فیلتر', 'url' => ['/filter/manage/index']],
    ['label' => 'سایرگزارشها', 'url' => ['/filter/manage/investigation']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/subject/views/subject/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
