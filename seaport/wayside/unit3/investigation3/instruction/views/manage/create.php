<?php

use nad\seaport\wayside\unit3\investigation3\instruction\models\Category;
use nad\seaport\wayside\unit3\investigation3\reference\models\Reference;
use nad\seaport\wayside\unit3\investigation3\proposal\models\Proposal;
use nad\seaport\wayside\unit3\investigation3\report\models\Report;
use nad\seaport\wayside\unit3\investigation3\method\models\Method;

$this->title = 'افزودن دستورالعمل';
$this->params['breadcrumbs'] = [
    'بندر',
    'واحد بندر',
    ['label' => 'واحد 3', 'url' => ['/seaport/wayside/unit3/manage/index']],
    ['label' => 'فعالیت ج', 'url' => ['/seaport/wayside/unit3/manage/investigation3']],
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