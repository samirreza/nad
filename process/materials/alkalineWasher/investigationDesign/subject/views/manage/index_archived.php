<?php

$this->title = 'لیست داده گاه موضوع';
$this->params['breadcrumbs'] = [
    'فرایند',
    'مواد',
    ['label' => 'شوینده قلیایی', 'url' => ['/alkalineWasher/manage/index']],
    ['label' => 'مطالعات کلی و دستورالعمل ها', 'url' => ['/alkalineWasher/manage/investigation-design']],
    'داده گاه موضوع',
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه موضوع',
        'url' => ['/alkalineWasher/investigationDesign/subject/manage/index']
    ],
    [
        'label' => 'داده گاه موضوع',
        'url' => ['/alkalineWasher/investigationDesign/subject/manage/archived-index']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/alkalineWasher/investigationDesign/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/subject/views/subject/index_archived', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
