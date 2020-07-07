<?php

$this->title = 'شناسنامه ' . $source->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'استخر', 'url' => ['/process/ird/pool/manage/index']],
    ['label' => 'بررسی', 'url' => ['/process/ird/pool/manage/investigation']],
    ['label' => 'لیست منشا', 'url' => ['index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/source/views/source/certificate', [
    'source' => $source,
    'moduleId' => 'pool',
    'baseRoute' => '/process/ird/pool/investigation'
]);
