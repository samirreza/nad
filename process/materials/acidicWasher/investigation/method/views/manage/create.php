<?php

use nad\process\materials\acidicWasher\investigation\reference\models\Reference;

$this->title = 'افزودن روش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'مواد',
    ['label' => 'شوینده اسیدی', 'url' => ['/acidicWasher/manage/index']],
    ['label' => 'بررسی', 'url' => ['/acidicWasher/manage/investigation']],
    $this->title
];

?>

<div class="method-create">
    <?= $this->render('@nad/common/modules/investigation/method/views/method/_form', [
        'model' => $model,
        'referenceConsumerCode' => Reference::CONSUMER_CODE
    ]) ?>
</div>
