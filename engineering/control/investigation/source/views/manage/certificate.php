<?php

$this->title = 'شناسنامه ' . $source->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'بررسی، پایش و طراحی',
    ['label' => 'کنترل', 'url' => ['/engineering/control/manage/index']],
    ['label' => 'بررسی', 'url' => ['/engineering/control/manage/investigation']],
    ['label' => 'لیست منشا', 'url' => ['index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/source/views/source/certificate', [
    'source' => $source,
    'moduleId' => 'control',
    'baseRoute' => '/control/investigation'
]);
