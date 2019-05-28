<?php

use nad\process\ird\pool\investigation\report\models\Report;

$this->title = 'ویرایش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'بررسی، پایش و طراحی',
    ['label' => 'استخر', 'url' => ['/pool/manage/index']],
    ['label' => 'بررسی', 'url' => ['/pool/manage/investigation']],
    ['label' => 'گزارش‌ها', 'url' => ['index']],
    ['label' => $model->title, 'url' => ['view', 'id' => $model->id]],
    $this->title
];

?>

<div class="report-update">
    <?= $this->render('@nad/common/modules/investigation/report/views/report/_form', [
        'model' => $model,
        'consumer' => Report::CONSUMER_CODE
    ]) ?>
</div>
