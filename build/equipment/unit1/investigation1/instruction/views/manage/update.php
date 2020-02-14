<?php

use nad\build\equipment\unit1\investigation1\instruction\models\Category;
use nad\build\equipment\unit1\investigation1\reference\models\Reference;
use nad\build\equipment\unit1\investigation1\proposal\models\Proposal;
use nad\build\equipment\unit1\investigation1\report\models\Report;
use nad\build\equipment\unit1\investigation1\method\models\Method;

$this->title = 'ویرایش';
$this->params['breadcrumbs'] = [
    'احداث',
    'تجهیزات',
    ['label' => 'واحد 1', 'url' => ['/build/equipment/unit1/manage/index']],
    ['label' => 'فعالیت الف', 'url' => ['/build/equipment/unit1/manage/investigation1']],
    ['label' => 'لیست دستورالعمل', 'url' => ['index']],
    ['label' => $model->title, 'url' => ['view', 'id' => $model->id]],
    $this->title
];

?>

<div class="instruction-update">
    <?= $this->render('@nad/common/modules/investigation/instruction/views/instruction/_form', [
        'model' => $model,
        'categoryConsumerCode' => Category::CONSUMER_CODE,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'proposalConsumerCode' => Proposal::CONSUMER_CODE,
        'reportConsumerCode' => Report::CONSUMER_CODE,
        'methodConsumerCode' => Method::CONSUMER_CODE,
    ]) ?>
</div>
