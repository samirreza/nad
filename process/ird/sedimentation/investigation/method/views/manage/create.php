<?php

use nad\process\ird\sedimentation\investigation\method\models\Method;

$this->title = 'افزودن روش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'ته نشینی', 'url' => ['/sedimentation/manage/index']],
    ['label' => 'بررسی', 'url' => ['/sedimentation/manage/investigation']],
    $this->title
];

?>

<div class="method-create">
    <?= $this->render('@nad/common/modules/investigation/method/views/method/_form', [
        'model' => $model,
        'consumer' => Method::CONSUMER_CODE
    ]) ?>
</div>
