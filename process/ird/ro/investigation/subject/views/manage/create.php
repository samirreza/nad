<?php

use nad\process\ird\ro\investigation\reference\models\Reference;
use nad\process\ird\ro\investigation\proposal\models\Proposal;
use nad\process\ird\ro\investigation\report\models\Report;
use nad\process\ird\ro\investigation\method\models\Method;

$this->title = 'افزودن موضوع';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'آر او', 'url' => ['/process/ird/ro/manage/index']],
    ['label' => 'سایرگزارشها', 'url' => ['/process/ird/ro/manage/investigation']],
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
