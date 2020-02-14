<?php

use nad\build\well\unit1\investigation5\reference\models\Reference;
use nad\build\well\unit1\investigation5\proposal\models\Proposal;
use nad\build\well\unit1\investigation5\report\models\Report;
use nad\build\well\unit1\investigation5\method\models\Method;

$this->title = 'افزودن موضوع';
$this->params['breadcrumbs'] = [
    'احداث',
    'چاه',
    ['label' => 'واحد 1', 'url' => ['/build/well/unit1/manage/index']],
    ['label' => 'فعالیت ه', 'url' => ['/build/well/unit1/manage/investigation5']],
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
