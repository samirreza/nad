<?php

use nad\process\ird\graphene\investigation\reference\models\Reference;
use nad\process\ird\graphene\investigation\proposal\models\Proposal;
use nad\process\ird\graphene\investigation\report\models\Report;
use nad\process\ird\graphene\investigation\method\models\Method;

$this->title = 'افزودن موضوع';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'گرافن', 'url' => ['/process/ird/graphene/manage/index']],
    ['label' => 'سایرگزارشها', 'url' => ['/process/ird/graphene/manage/investigation']],
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
