<?php

use nad\engineering\electricity\device\investigationMonitorMethods\method\models\Category;
use nad\engineering\electricity\device\investigationMonitorMethods\reference\models\Reference;
use nad\engineering\electricity\device\investigationMonitorMethods\proposal\models\Proposal;
use nad\engineering\electricity\device\investigationMonitorMethods\report\models\Report;

$this->title = 'افزودن روش';
$this->params['breadcrumbs'] = [
    'فنی',
    'برق',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/electricity/device/manage/index']],
    ['label' => 'بررسی روشهای پایش', 'url' => ['/engineering/electricity/device/manage/investigation-monitor-methods']],
    $this->title
];

?>

<div class="method-create">
    <?= $this->render('@nad/common/modules/investigation/method/views/method/_form', [
        'model' => $model,
        'categoryConsumerCode' => Category::CONSUMER_CODE,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'proposalConsumerCode' => Proposal::CONSUMER_CODE,
        'reportConsumerCode' => Report::CONSUMER_CODE,
    ]) ?>
</div>
