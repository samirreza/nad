<?php

use nad\engineering\mechanics\device\investigationImprovement\reference\models\Reference;
use nad\engineering\mechanics\device\investigationImprovement\proposal\models\Proposal;
use nad\engineering\mechanics\device\investigationImprovement\report\models\Report;
use nad\engineering\mechanics\device\investigationImprovement\method\models\Method;

$this->title = 'ویرایش';
$this->params['breadcrumbs'] = [
    'فنی',
    'مکانیک',
    ['label' => 'مراحل', 'url' => ['/engineering/mechanics/device/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/mechanics/device/manage/investigation-improvement']],
    ['label' => 'لیست موضوع های فعال', 'url' => ['index']],
    ['label' => $model->title, 'url' => ['view', 'id' => $model->id]],
    $this->title
];

?>

<div class="subject-update">
    <?= $this->render('@nad/common/modules/investigation/subject/views/subject/_form', [
        'model' => $model,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'proposalConsumerCode' => Proposal::CONSUMER_CODE,
        'reportConsumerCode' => Report::CONSUMER_CODE,
        'methodConsumerCode' => Method::CONSUMER_CODE,
    ]) ?>
</div>
