<?php

use nad\process\ird\microbial\investigationMonitor\instruction\models\Category;
use nad\process\ird\microbial\investigationMonitor\reference\models\Reference;
use nad\process\ird\microbial\investigationMonitor\proposal\models\Proposal;
use nad\process\ird\microbial\investigationMonitor\report\models\Report;
use nad\process\ird\microbial\investigationMonitor\method\models\Method;

$this->title = 'افزودن دستورالعمل';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'میکروبیولوژی', 'url' => ['/microbial/manage/index']],
    ['label' => 'بررسی پایش', 'url' => ['/microbial/manage/investigation-monitor']],
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
