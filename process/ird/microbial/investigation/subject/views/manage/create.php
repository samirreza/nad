<?php

use nad\process\ird\microbial\investigation\reference\models\Reference;
use nad\process\ird\microbial\investigation\proposal\models\Proposal;
use nad\process\ird\microbial\investigation\report\models\Report;
use nad\process\ird\microbial\investigation\method\models\Method;

$this->title = 'افزودن موضوع';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'میکروبیولوژی', 'url' => ['/microbial/manage/index']],
    ['label' => 'سایرگزارشها', 'url' => ['/microbial/manage/investigation']],
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
