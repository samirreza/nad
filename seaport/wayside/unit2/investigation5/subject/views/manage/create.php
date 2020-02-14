<?php

use nad\seaport\wayside\unit2\investigation5\reference\models\Reference;
use nad\seaport\wayside\unit2\investigation5\proposal\models\Proposal;
use nad\seaport\wayside\unit2\investigation5\report\models\Report;
use nad\seaport\wayside\unit2\investigation5\method\models\Method;

$this->title = 'افزودن موضوع';
$this->params['breadcrumbs'] = [
    'بندر',
    'واحد بندر',
    ['label' => 'واحد 2', 'url' => ['/seaport/wayside/unit2/manage/index']],
    ['label' => 'فعالیت ه', 'url' => ['/seaport/wayside/unit2/manage/investigation5']],
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
