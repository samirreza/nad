<?php

$this->title = 'شناسنامه ' . $proposal->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'بررسی، پایش و طراحی',
    ['label' => 'میکروبی', 'url' => ['/microbial/manage/index']],
    ['label' => 'بررسی', 'url' => ['/microbial/manage/investigation']],
    ['label' => 'لیست پروپوزال', 'url' => ['index']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/certificate', [
    'source' => $source,
    'proposal' => $proposal,
    'report' => $report,
    'moduleId' => 'microbial',
    'baseRoute' => '/microbial/investigation'
]);