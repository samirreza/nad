<?php

use nad\temporary\supply\unit1\investigation3\instruction\models\Category;
use nad\temporary\supply\unit1\investigation3\reference\models\Reference;
use nad\temporary\supply\unit1\investigation3\proposal\models\Proposal;
use nad\temporary\supply\unit1\investigation3\report\models\Report;
use nad\temporary\supply\unit1\investigation3\method\models\Method;

$this->title = 'افزودن دستورالعمل';
$this->params['breadcrumbs'] = [
    'موقت',
    'تامین',
    ['label' => 'واحد 1', 'url' => ['/temporary/supply/unit1/manage/index']],
    ['label' => 'فعالیت ج', 'url' => ['/temporary/supply/unit1/manage/investigation3']],
    $this->title
];

?>

<div class="instruction-create">
    <?= $this->render('@nad/common/modules/investigation/instruction/views/instruction/_form', [
        'model' => $model,
        'categoryConsumerCode' => Category::CONSUMER_CODE,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'proposalConsumerCode' => Proposal::CONSUMER_CODE,
        'reportConsumerCode' => Report::CONSUMER_CODE,
        'methodConsumerCode' => Method::CONSUMER_CODE,
    ]) ?>
</div>
