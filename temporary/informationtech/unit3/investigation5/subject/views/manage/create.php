<?php

use nad\temporary\informationtech\unit3\investigation5\reference\models\Reference;
use nad\temporary\informationtech\unit3\investigation5\proposal\models\Proposal;
use nad\temporary\informationtech\unit3\investigation5\report\models\Report;
use nad\temporary\informationtech\unit3\investigation5\method\models\Method;

$this->title = 'افزودن موضوع';
$this->params['breadcrumbs'] = [
    'موقت',
    'آی تی',
    ['label' => 'واحد 3', 'url' => ['/temporary/informationtech/unit3/manage/index']],
    ['label' => 'فعالیت ه', 'url' => ['/temporary/informationtech/unit3/manage/investigation5']],
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
