<?php

use nad\process\ird\microbial\investigation\report\models\Report;

$this->title = 'درج گزارش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'بررسی، پایش و طراحی',
    ['label' => 'میکروبی', 'url' => ['/microbial/manage/index']],
    ['label' => 'بررسی', 'url' => ['/microbial/manage/investigation']],
    $this->title
];

?>

<div class="report-create">
    <?= $this->render('@nad/common/modules/investigation/report/views/report/_form', [
        'model' => $model,
        'consumer' => Report::CONSUMER_CODE
    ]) ?>
</div>
