<?php

use nad\engineering\construction\stage\investigationImprovement\instruction\models\Category;
use nad\engineering\construction\stage\investigationImprovement\reference\models\Reference;
use nad\engineering\construction\stage\investigationImprovement\proposal\models\Proposal;
use nad\engineering\construction\stage\investigationImprovement\report\models\Report;
use nad\engineering\construction\stage\investigationImprovement\method\models\Method;

$this->title = 'ویرایش';
$this->params['breadcrumbs'] = [
    'فنی',
    'ساختمان',
    ['label' => 'مراحل', 'url' => ['/engineering/construction/stage/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/construction/stage/manage/investigation-improvement']],
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
