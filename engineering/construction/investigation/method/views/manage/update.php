<?php

use nad\engineering\construction\investigation\method\models\Method;

$this->title = 'ویرایش';
$this->params['breadcrumbs'] = [
    'فنی',
    'بررسی، پایش و طراحی',
    ['label' => 'ساختمان', 'url' => ['/engineering/construction/manage/index']],
    ['label' => 'بررسی', 'url' => ['/engineering/construction/manage/investigation']],
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
