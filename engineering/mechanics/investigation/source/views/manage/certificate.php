<?php

$this->title = 'شناسنامه ' . $source->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'بررسی، پایش و طراحی',
    ['label' => 'مکانیک', 'url' => ['/engineering/mechanics/manage/index']],
    ['label' => 'بررسی', 'url' => ['/engineering/mechanics/manage/investigation']],
    ['label' => 'لیست منشا', 'url' => ['index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/source/views/source/certificate', [
    'source' => $source,
    'moduleId' => 'mechanics',
    'baseRoute' => '/mechanics/investigation'
]);
