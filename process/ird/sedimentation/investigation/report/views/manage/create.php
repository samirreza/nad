<?php

use nad\process\ird\sedimentation\investigation\report\models\Report;

$this->title = 'افزودن گزارش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'ته نشینی', 'url' => ['/sedimentation/manage/index']],
    ['label' => 'بررسی', 'url' => ['/sedimentation/manage/investigation']],
    $this->title
];

?>

<div class="report-create">
    <?= $this->render('@nad/common/modules/investigation/report/views/report/_form', [
        'model' => $model,
        'consumer' => Report::CONSUMER_CODE
    ]) ?>
</div>
