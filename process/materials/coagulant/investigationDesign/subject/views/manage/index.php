<?php

$this->title = 'لیست موضوع های فعال';
$this->params['breadcrumbs'] = [
    'فرایند',
    'مواد',
    ['label' => 'منعقدکننده', 'url' => ['/coagulant/manage/index']],
    ['label' => 'مطالعات کلی و دستورالعمل ها', 'url' => ['/coagulant/manage/investigation-design']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/subject/views/subject/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
