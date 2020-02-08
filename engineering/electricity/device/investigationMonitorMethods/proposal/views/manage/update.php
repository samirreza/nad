<?php

use nad\engineering\electricity\device\investigationMonitorMethods\source\models\Source;
use nad\engineering\electricity\device\investigationMonitorMethods\proposal\models\Category;
use nad\engineering\electricity\device\investigationMonitorMethods\reference\models\Reference;

$this->title = 'ویرایش پروپوزال';
$this->params['breadcrumbs'] = [
    'فنی',
    'برق',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/electricity/device/manage/index']],
    ['label' => 'بررسی روشهای پایش', 'url' => ['/engineering/electricity/device/manage/investigation-monitor-methods']],
    ['label' => 'لیست پروپوزال', 'url' => ['index']],
    ['label' => $model->title, 'url' => ['view', 'id' => $model->id]],
    $this->title
];

?>

<div class="proposal-update">
    <?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/_form', [
        'model' => $model,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'categoryConsumerCode' => Category::CONSUMER_CODE,
        'sourceConsumerCode' => Source::CONSUMER_CODE
    ]) ?>
</div>
