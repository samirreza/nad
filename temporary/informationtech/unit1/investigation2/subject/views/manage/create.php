<?php

use nad\temporary\informationtech\unit1\investigation2\reference\models\Reference;
use nad\temporary\informationtech\unit1\investigation2\proposal\models\Proposal;
use nad\temporary\informationtech\unit1\investigation2\report\models\Report;
use nad\temporary\informationtech\unit1\investigation2\method\models\Method;

$this->title = 'افزودن موضوع';
$this->params['breadcrumbs'] = [
    'موقت',
    'آی تی',
    ['label' => 'واحد 1', 'url' => ['/temporary/informationtech/unit1/manage/index']],
    ['label' => 'فعالیت ب', 'url' => ['/temporary/informationtech/unit1/manage/investigation2']],
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
