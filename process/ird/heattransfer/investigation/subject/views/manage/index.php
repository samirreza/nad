<?php

$this->title = 'لیست موضوع های فعال';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'انتقال حرارت', 'url' => ['/heattransfer/manage/index']],
    ['label' => 'سایرگزارشها', 'url' => ['/heattransfer/manage/investigation']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/subject/views/subject/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
