<?php

use nad\engineering\mechanics\stage\investigationMonitorMethods\instruction\models\Category;
use nad\engineering\mechanics\stage\investigationMonitorMethods\reference\models\Reference;
use nad\engineering\mechanics\stage\investigationMonitorMethods\proposal\models\Proposal;
use nad\engineering\mechanics\stage\investigationMonitorMethods\report\models\Report;
use nad\engineering\mechanics\stage\investigationMonitorMethods\method\models\Method;

$this->title = 'افزودن دستورالعمل';
$this->params['breadcrumbs'] = [
    'فنی',
    'مکانیک',
    ['label' => 'مراحل', 'url' => ['/engineering/mechanics/stage/manage/index']],
    ['label' => 'بررسی روشهای پایش', 'url' => ['/engineering/mechanics/stage/manage/investigation-monitor-methods']],
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
