<?php

use nad\engineering\piping\stage\investigation\report\models\Report;

$this->title = 'ویرایش';
$this->params['breadcrumbs'] = [
    'فنی',
    'بررسی، پایش و طراحی',
    'لوله کشی',
    ['label' => 'مراحل', 'url' => ['/engineering/piping/stage']], 
    ['label' => 'بررسی', 'url' => ['/engineering/piping/stage/manage/investigation']],
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
