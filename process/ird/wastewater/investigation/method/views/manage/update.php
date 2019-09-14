<?php

use nad\process\ird\wastewater\investigation\method\models\Method;

$this->title = 'ویرایش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'بررسی، پایش و طراحی',
    ['label' => 'پساب', 'url' => ['/wastewater/manage/index']],
    ['label' => 'بررسی', 'url' => ['/wastewater/manage/investigation']],
    ['label' => 'لیست گزارش', 'url' => ['index']],
    ['label' => $model->title, 'url' => ['view', 'id' => $model->id]],
    $this->title
];

?>

<div class="method-update">
    <?= $this->render('@nad/common/modules/investigation/method/views/method/_form', [
        'model' => $model,
        'consumer' => Method::CONSUMER_CODE
    ]) ?>
</div>
