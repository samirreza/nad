<?php

use nad\engineering\construction\stage\investigationMonitorMethods\report\models\Category;
use nad\engineering\construction\stage\investigationMonitorMethods\reference\models\Reference;
use nad\engineering\construction\stage\investigationMonitorMethods\proposal\models\Proposal;

$this->title = 'ویرایش';
$this->params['breadcrumbs'] = [
    'فنی',
    'ساختمان',
    ['label' => 'مراحل', 'url' => ['/engineering/construction/stage/manage/index']],
    ['label' => 'بررسی روشهای پایش', 'url' => ['/engineering/construction/stage/manage/investigation-monitor-methods']],
    ['label' => 'لیست گزارش', 'url' => ['index']],
    ['label' => $model->title, 'url' => ['view', 'id' => $model->id]],
    $this->title
];

?>

<div class="report-update">
    <?= $this->render('@nad/common/modules/investigation/report/views/report/_form', [
        'model' => $model,
        'categoryConsumerCode' => Category::CONSUMER_CODE,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'proposalConsumerCode' => Proposal::CONSUMER_CODE,
    ]) ?>
</div>
