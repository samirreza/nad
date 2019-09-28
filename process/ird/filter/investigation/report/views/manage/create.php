<?php

use nad\process\ird\filter\investigation\report\models\Report;

$this->title = 'درج گزارش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'فیلتر شنی', 'url' => ['/filter/manage/index']],
    ['label' => 'بررسی', 'url' => ['/filter/manage/investigation']],
    $this->title
];

?>

<div class="report-create">
    <?= $this->render('@nad/common/modules/investigation/report/views/report/_form', [
        'model' => $model,
        'consumer' => Report::CONSUMER_CODE
    ]) ?>
</div>
