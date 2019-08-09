<?php

use nad\engineering\electricity\investigation\report\models\Report;

$this->title = 'ویرایش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'بررسی، پایش و طراحی',
    ['label' => 'برق', 'url' => ['/engineering/electricity/manage/index']],
    ['label' => 'بررسی', 'url' => ['/engineering/electricity/manage/investigation']],
    ['label' => 'لیست گزارش', 'url' => ['index']],
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
