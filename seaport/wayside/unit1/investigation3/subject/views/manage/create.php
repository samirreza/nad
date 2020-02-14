<?php

use nad\seaport\wayside\unit1\investigation3\reference\models\Reference;
use nad\seaport\wayside\unit1\investigation3\proposal\models\Proposal;
use nad\seaport\wayside\unit1\investigation3\report\models\Report;
use nad\seaport\wayside\unit1\investigation3\method\models\Method;

$this->title = 'افزودن موضوع';
$this->params['breadcrumbs'] = [
    'بندر',
    'واحد بندر',
    ['label' => 'واحد 1', 'url' => ['/seaport/wayside/unit1/manage/index']],
    ['label' => 'فعالیت ج', 'url' => ['/seaport/wayside/unit1/manage/investigation3']],
    $this->title
];

?>

<div class="subject-create">
    <?= $this->render('@nad/common/modules/investigation/subject/views/subject/_form', [
        'model' => $model,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'proposalConsumerCode' => Proposal::CONSUMER_CODE,
        'reportConsumerCode' => Report::CONSUMER_CODE,
        'methodConsumerCode' => Method::CONSUMER_CODE,
    ]) ?>
</div>
