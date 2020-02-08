<?php

$this->title = 'لیست پروپوزالهای برنامه';
$this->params['breadcrumbs'] = [
    'فنی',
    'ابزار دقیق',
    ['label' => 'مراحل', 'url' => ['/engineering/instrument/stage/manage/index']],
    ['label' => 'بررسی روشهای پایش', 'url' => ['/engineering/instrument/stage/manage/investigation-monitor-methods']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
