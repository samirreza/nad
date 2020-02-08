<?php

use nad\engineering\construction\device\investigationDesign\instruction\models\Category;
use nad\engineering\construction\device\investigationDesign\reference\models\Reference;
use nad\engineering\construction\device\investigationDesign\proposal\models\Proposal;
use nad\engineering\construction\device\investigationDesign\report\models\Report;
use nad\engineering\construction\device\investigationDesign\method\models\Method;

$this->title = 'افزودن دستورالعمل';
$this->params['breadcrumbs'] = [
    'فنی',
    'ساختمان',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/construction/device/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/engineering/construction/device/manage/investigation-design']],
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
