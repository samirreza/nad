<?php

use nad\temporary\supply\unit1\investigation1\instruction\models\Category;
use nad\temporary\supply\unit1\investigation1\reference\models\Reference;
use nad\temporary\supply\unit1\investigation1\proposal\models\Proposal;
use nad\temporary\supply\unit1\investigation1\report\models\Report;
use nad\temporary\supply\unit1\investigation1\method\models\Method;

$this->title = 'ویرایش';
$this->params['breadcrumbs'] = [
    'موقت',
    'تامین',
    ['label' => 'واحد 1', 'url' => ['/temporary/supply/unit1/manage/index']],
    ['label' => 'فعالیت الف', 'url' => ['/temporary/supply/unit1/manage/investigation1']],
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
