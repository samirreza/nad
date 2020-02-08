<?php

use nad\engineering\control\stage\investigationMonitorMethods\instruction\models\Category;
use nad\engineering\control\stage\investigationMonitorMethods\reference\models\Reference;
use nad\engineering\control\stage\investigationMonitorMethods\proposal\models\Proposal;
use nad\engineering\control\stage\investigationMonitorMethods\report\models\Report;
use nad\engineering\control\stage\investigationMonitorMethods\method\models\Method;

$this->title = 'ویرایش';
$this->params['breadcrumbs'] = [
    'فنی',
    'کنترل',
    ['label' => 'مراحل', 'url' => ['/engineering/control/stage/manage/index']],
    ['label' => 'بررسی روشهای پایش', 'url' => ['/engineering/control/stage/manage/investigation-monitor-methods']],
    ['label' => 'لیست دستورالعمل', 'url' => ['index']],
    ['label' => $model->title, 'url' => ['view', 'id' => $model->id]],
    $this->title
];

?>

<div class="instruction-update">
    <?= $this->render('@nad/common/modules/investigation/instruction/views/instruction/_form', [
        'model' => $model,
        'categoryConsumerCode' => Category::CONSUMER_CODE,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'proposalConsumerCode' => Proposal::CONSUMER_CODE,
        'reportConsumerCode' => Report::CONSUMER_CODE,
        'methodConsumerCode' => Method::CONSUMER_CODE,
    ]) ?>
</div>
