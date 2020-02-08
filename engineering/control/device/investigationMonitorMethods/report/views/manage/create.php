<?php

use nad\engineering\control\device\investigationMonitorMethods\report\models\Category;
use nad\engineering\control\device\investigationMonitorMethods\reference\models\Reference;
use nad\engineering\control\device\investigationMonitorMethods\proposal\models\Proposal;

$this->title = 'افزودن گزارش';
$this->params['breadcrumbs'] = [
    'فنی',
    'کنترل',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/control/device/manage/index']],
    ['label' => 'بررسی روشهای پایش', 'url' => ['/engineering/control/device/manage/investigation-monitor-methods']],
    $this->title
];

?>

<div class="report-create">
    <?= $this->render('@nad/common/modules/investigation/report/views/report/_form', [
        'model' => $model,
        'categoryConsumerCode' => Category::CONSUMER_CODE,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'proposalConsumerCode' => Proposal::CONSUMER_CODE,
    ]) ?>
</div>
