<?php

use nad\engineering\construction\investigation\method\models\Method;

$this->title = 'درج روش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'بررسی، پایش و طراحی',
    ['label' => 'ساختمان', 'url' => ['/engineering/construction/manage/index']],
    ['label' => 'بررسی', 'url' => ['/engineering/construction/manage/investigation']],
    $this->title
];

?>

<div class="method-create">
    <?= $this->render('@nad/common/modules/investigation/method/views/method/_form', [
        'model' => $model,
        'consumer' => Method::CONSUMER_CODE
    ]) ?>
</div>
