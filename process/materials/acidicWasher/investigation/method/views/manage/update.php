<?php

use nad\process\materials\acidicWasher\investigation\reference\models\Reference;

$this->title = 'ویرایش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'مواد',
    ['label' => 'شوینده اسیدی', 'url' => ['/acidicWasher/manage/index']],
    ['label' => 'بررسی', 'url' => ['/acidicWasher/manage/investigation']],
    ['label' => 'لیست گزارش', 'url' => ['index']],
    ['label' => $model->title, 'url' => ['view', 'id' => $model->id]],
    $this->title
];

?>

<div class="method-update">
    <?= $this->render('@nad/common/modules/investigation/method/views/method/_form', [
        'model' => $model,
        'referenceConsumerCode' => Reference::CONSUMER_CODE
    ]) ?>
</div>
