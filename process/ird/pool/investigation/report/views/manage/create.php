<?php

use nad\process\ird\pool\investigation\report\models\Report;

$this->title = 'درج گزارش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'استخر', 'url' => ['/process/ird/pool/manage/index']],
    ['label' => 'بررسی', 'url' => ['/process/ird/pool/manage/investigation']],
    $this->title
];

?>

<div class="report-create">
    <?= $this->render('@nad/common/modules/investigation/report/views/report/_form', [
        'model' => $model,
        'consumer' => Report::CONSUMER_CODE
    ]) ?>
</div>
