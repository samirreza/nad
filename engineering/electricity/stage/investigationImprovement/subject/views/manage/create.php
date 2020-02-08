<?php

use nad\engineering\electricity\stage\investigationImprovement\reference\models\Reference;
use nad\engineering\electricity\stage\investigationImprovement\proposal\models\Proposal;
use nad\engineering\electricity\stage\investigationImprovement\report\models\Report;
use nad\engineering\electricity\stage\investigationImprovement\method\models\Method;

$this->title = 'افزودن موضوع';
$this->params['breadcrumbs'] = [
    'فنی',
    'برق',
    ['label' => 'مراحل', 'url' => ['/engineering/electricity/stage/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/electricity/stage/manage/investigation-improvement']],
    $this->title
];

?>

<div class="subject-create">
    <?= $this->render('@nad/common/modules/investigation/subject/views/subject/_form', [
        'model' => $model,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'proposalConsumerCode' => Proposal::CONSUMER_CODE,
        'reportConsumerCode' => Report::CONSUMER_CODE,
        'methodConsumerCode' => Method::CONSUMER_CODE,
    ]) ?>
</div>
