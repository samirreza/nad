<?php

use nad\engineering\piping\device\investigationMonitorMethods\instruction\models\Category;
use nad\engineering\piping\device\investigationMonitorMethods\reference\models\Reference;
use nad\engineering\piping\device\investigationMonitorMethods\proposal\models\Proposal;
use nad\engineering\piping\device\investigationMonitorMethods\report\models\Report;
use nad\engineering\piping\device\investigationMonitorMethods\method\models\Method;

$this->title = 'ویرایش';
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/piping/device/manage/index']],
    ['label' => 'بررسی روشهای پایش', 'url' => ['/engineering/piping/device/manage/investigation-monitor-methods']],
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
