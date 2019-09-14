<?php

$this->title = 'شناسنامه ' . $source->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'بررسی، پایش و طراحی',
    ['label' => 'پساب', 'url' => ['/wastewater/manage/index']],
    ['label' => 'بررسی', 'url' => ['/wastewater/manage/investigation']],
    ['label' => 'لیست منشا', 'url' => ['index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/source/views/source/certificate', [
    'source' => $source,
    'moduleId' => 'wastewater',
    'baseRoute' => '/wastewater/investigation'
]);
