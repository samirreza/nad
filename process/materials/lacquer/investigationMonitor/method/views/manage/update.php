<?php

use nad\process\materials\lacquer\investigationMonitor\reference\models\Reference;

$this->title = 'ویرایش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'لاک بیرنگ', 'url' => ['/lacquer/manage/index']],
    ['label' => 'بررسی', 'url' => ['/lacquer/manage/investigation-monitor']],
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
