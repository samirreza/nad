<?php

use nad\factory\production\unit3\investigation1\instruction\models\Category;
use nad\factory\production\unit3\investigation1\reference\models\Reference;
use nad\factory\production\unit3\investigation1\proposal\models\Proposal;
use nad\factory\production\unit3\investigation1\report\models\Report;
use nad\factory\production\unit3\investigation1\method\models\Method;

$this->title = 'افزودن دستورالعمل';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'تولید',
    ['label' => 'تولید', 'url' => ['/factory/production/unit3/manage/index']],
    ['label' => 'فعالیت الف', 'url' => ['/factory/production/unit3/manage/investigation1']],
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
