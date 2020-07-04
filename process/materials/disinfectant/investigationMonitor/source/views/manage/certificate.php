<?php

$this->title = 'شناسنامه ' . $source->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'گندزدا', 'url' => ['/process/materials/disinfectant/manage/index']],
    ['label' => 'بررسی پایش', 'url' => ['/process/materials/disinfectant/manage/investigation-monitor']],
    'برنامه منشا',
    ['label' => 'لیست منشاهای برنامه', 'url' => ['index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/source/views/source/certificate', [
    'source' => $source,
    'moduleId' => 'disinfectant',
    'baseRoute' => '/disinfectant/investigationMonitor'
]);
