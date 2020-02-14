<?php

use nad\temporary\supply\unit1\investigation2\instruction\models\Category;
use nad\temporary\supply\unit1\investigation2\reference\models\Reference;
use nad\temporary\supply\unit1\investigation2\proposal\models\Proposal;
use nad\temporary\supply\unit1\investigation2\report\models\Report;
use nad\temporary\supply\unit1\investigation2\method\models\Method;

$this->title = 'افزودن دستورالعمل';
$this->params['breadcrumbs'] = [
    'موقت',
    'تامین',
    ['label' => 'واحد 1', 'url' => ['/temporary/supply/unit1/manage/index']],
    ['label' => 'فعالیت ب', 'url' => ['/temporary/supply/unit1/manage/investigation2']],
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
