<?php

use nad\engineering\geotechnics\device\investigationMonitorMethods\method\models\Category;
use nad\engineering\geotechnics\device\investigationMonitorMethods\reference\models\Reference;
use nad\engineering\geotechnics\device\investigationMonitorMethods\proposal\models\Proposal;
use nad\engineering\geotechnics\device\investigationMonitorMethods\report\models\Report;

$this->title = 'افزودن روش';
$this->params['breadcrumbs'] = [
    'فنی',
    'ژئوتکنیک',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/geotechnics/device/manage/index']],
    ['label' => 'بررسی روشهای پایش', 'url' => ['/engineering/geotechnics/device/manage/investigation-monitor-methods']],
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
