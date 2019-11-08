<?php

use nad\engineering\piping\stage\investigationMonitorMethods\report\models\Category;
use nad\engineering\piping\stage\investigationMonitorMethods\reference\models\Reference;
use nad\engineering\piping\stage\investigationMonitorMethods\proposal\models\Proposal;

$this->title = 'افزودن گزارش';
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'مراحل', 'url' => ['/engineering/piping/stage/manage/index']],
    ['label' => 'بررسی روشهای پایش', 'url' => ['/engineering/piping/stage/manage/investigation-monitor-methods']],
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
