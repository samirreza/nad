<?php

use nad\engineering\instrument\device\investigationImprovement\instruction\models\Category;
use nad\engineering\instrument\device\investigationImprovement\reference\models\Reference;
use nad\engineering\instrument\device\investigationImprovement\proposal\models\Proposal;
use nad\engineering\instrument\device\investigationImprovement\report\models\Report;
use nad\engineering\instrument\device\investigationImprovement\method\models\Method;

$this->title = 'افزودن دستورالعمل';
$this->params['breadcrumbs'] = [
    'فنی',
    'ابزار دقیق',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/instrument/device/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/instrument/device/manage/investigation-improvement']],
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
