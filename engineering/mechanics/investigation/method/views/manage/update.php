<?php

use nad\engineering\mechanics\investigation\method\models\Method;

$this->title = 'ویرایش';
$this->params['breadcrumbs'] = [
    'فنی',
    'بررسی، پایش و طراحی',
    ['label' => 'مکانیک', 'url' => ['/engineering/mechanics/manage/index']],
    ['label' => 'بررسی', 'url' => ['/engineering/mechanics/manage/investigation']],
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
