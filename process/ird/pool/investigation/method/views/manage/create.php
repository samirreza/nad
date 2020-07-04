<?php

use nad\process\ird\pool\investigation\method\models\Method;

$this->title = 'درج روش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'استخر', 'url' => ['/process/ird/pool/manage/index']],
    ['label' => 'بررسی', 'url' => ['/process/ird/pool/manage/investigation']],
    $this->title
];

?>

<div class="method-create">
    <?= $this->render('@nad/common/modules/investigation/method/views/method/_form', [
        'model' => $model,
        'consumer' => Method::CONSUMER_CODE
    ]) ?>
</div>
