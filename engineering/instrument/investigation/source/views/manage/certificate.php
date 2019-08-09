<?php

$this->title = 'شناسنامه ' . $source->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'بررسی، پایش و طراحی',
    ['label' => 'ابزار دقیق', 'url' => ['/engineering/instrument/manage/index']],
    ['label' => 'بررسی', 'url' => ['/engineering/instrument/manage/investigation']],
    ['label' => 'لیست منشا', 'url' => ['index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/source/views/source/certificate', [
    'source' => $source,
    'moduleId' => 'instrument',
    'baseRoute' => '/instrument/investigation'
]);
