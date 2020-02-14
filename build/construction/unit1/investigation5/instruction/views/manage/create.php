<?php

use nad\build\construction\unit1\investigation5\instruction\models\Category;
use nad\build\construction\unit1\investigation5\reference\models\Reference;
use nad\build\construction\unit1\investigation5\proposal\models\Proposal;
use nad\build\construction\unit1\investigation5\report\models\Report;
use nad\build\construction\unit1\investigation5\method\models\Method;

$this->title = 'افزودن دستورالعمل';
$this->params['breadcrumbs'] = [
    'احداث',
    'ساختمان',
    ['label' => 'واحد 1', 'url' => ['/build/construction/unit1/manage/index']],
    ['label' => 'فعالیت ه', 'url' => ['/build/construction/unit1/manage/investigation5']],
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
