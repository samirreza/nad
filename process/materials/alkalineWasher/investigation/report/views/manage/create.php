<?php

use nad\process\materials\alkalineWasher\investigation\category\models\Category;
use nad\process\materials\alkalineWasher\investigation\reference\models\Reference;

$this->title = 'افزودن گزارش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'مواد',
    ['label' => 'شوینده قلیایی', 'url' => ['/process/materials/alkalineWasher/manage/index']],
    ['label' => 'بررسی', 'url' => ['/process/materials/alkalineWasher/manage/investigation']],
    $this->title
];

?>

<div class="report-create">
    <?= $this->render('@nad/common/modules/investigation/report/views/report/_form', [
        'model' => $model,
        'categoryConsumerCode' => Category::CONSUMER_CODE,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
    ]) ?>
</div>
