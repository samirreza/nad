<?php

use nad\process\ird\ro\investigation\report\models\Report;

$this->title = 'درج گزارش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'آر او', 'url' => ['/ro/manage/index']],
    ['label' => 'بررسی', 'url' => ['/ro/manage/investigation']],
    $this->title
];

?>

<div class="report-create">
    <?= $this->render('@nad/common/modules/investigation/report/views/report/_form', [
        'model' => $model,
        'consumer' => Report::CONSUMER_CODE
    ]) ?>
</div>
