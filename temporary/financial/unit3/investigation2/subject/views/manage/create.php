<?php

use nad\temporary\financial\unit3\investigation2\reference\models\Reference;
use nad\temporary\financial\unit3\investigation2\proposal\models\Proposal;
use nad\temporary\financial\unit3\investigation2\report\models\Report;
use nad\temporary\financial\unit3\investigation2\method\models\Method;

$this->title = 'افزودن موضوع';
$this->params['breadcrumbs'] = [
    'موقت',
    'مالی',
    ['label' => 'واحد 3', 'url' => ['/temporary/financial/unit3/manage/index']],
    ['label' => 'فعالیت ب', 'url' => ['/temporary/financial/unit3/manage/investigation2']],
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
