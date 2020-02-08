<?php

use nad\engineering\electricity\stage\investigationImprovement\method\models\Category;
use nad\engineering\electricity\stage\investigationImprovement\reference\models\Reference;
use nad\engineering\electricity\stage\investigationImprovement\proposal\models\Proposal;
use nad\engineering\electricity\stage\investigationImprovement\report\models\Report;

$this->title = 'افزودن روش';
$this->params['breadcrumbs'] = [
    'فنی',
    'برق',
    ['label' => 'مراحل', 'url' => ['/engineering/electricity/stage/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/electricity/stage/manage/investigation-improvement']],
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
